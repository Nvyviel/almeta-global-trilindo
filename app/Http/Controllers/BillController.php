<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Bill;
use Midtrans\Config;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function createBill()
    {
        return view('user.bills');
    }

    public function listBill(Request $request) // Tambahkan parameter Request
    {
        $query = Bill::with(['user', 'shipment'])
            ->where('user_id', auth()->id());

        // Filtering logic
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            if ($filter !== 'all') {
                $query->where('status', ucfirst($filter)); // Capitalize first letter for matching DB value
            }
        }

        $bills = $query->latest()->paginate(10);

        // Append query parameters to pagination links
        $bills->appends($request->query());

        return view('user.list-bill', compact('bills'));
    }

    public function detailBill(Bill $bill)
    {
        $bill->load(['user', 'shipment', 'container']);

        $weightRate = ceil($bill->container->weight / 100) * 90000;

        $containerTotalRate = $bill->container->rate_per_container * $bill->container->quantity;

        $totalPrice = $bill->shipment->rate + $containerTotalRate + $weightRate + 250000;

        return view('user.bill-detail', compact('bill', 'weightRate', 'containerTotalRate', 'totalPrice'));
    }

    public function getSnapToken($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Silakan login untuk melakukan transaksi.'], 401);
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $bill = Bill::find($id);

        if (!$bill) {
            return response()->json(['error' => 'Tagihan tidak ditemukan.'], 404);
        }

        $shipment = Shipment::find($bill->shipment_id);
        $container = Container::find($bill->container_id);

        if (!$shipment || !$container) {
            return response()->json(['error' => 'Data tidak lengkap.'], 404);
        }

        // Hitung total harga
        $weightRate = ceil($container->weight / 100) * 90000;
        $containerTotalRate = $container->rate_per_container * $container->quantity;
        $totalPrice = $shipment->rate + $containerTotalRate + $bill->document_price + $weightRate;
        
        $params = [
            'transaction_details' => [
                'order_id' => $bill->bill_id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

            // Debugging Log
            Log::info('Received Midtrans Callback', ['request' => $request->all()]);

            $notificationBody = json_decode($request->getContent(), true);

            if (!isset($notificationBody['order_id']) || !isset($notificationBody['transaction_status'])) {
                Log::error('Invalid Midtrans Callback Data', ['data' => $notificationBody]);
                return response()->json(['error' => 'Invalid data'], 400);
            }

            $orderId = $notificationBody['order_id'];
            $transactionStatus = $notificationBody['transaction_status'];
            $fraudStatus = $notificationBody['fraud_status'] ?? null;
            $paymentType = $notificationBody['payment_type'] ?? null;

            // Extract bill ID from order_id (removing 'BILL-' prefix)
            $billId = str_replace('BILL-', '', $orderId);

            // Find the bill
            $bill = Bill::find($billId);
            if (!$bill) {
                Log::error('Bill not found for order: ' . $orderId);
                return response()->json(['error' => 'Order not found'], 404);
            }

            Log::info('Processing transaction', [
                'order_id' => $orderId,
                'status' => $transactionStatus,
                'payment_type' => $paymentType
            ]);

            // Update bill status based on transaction status
            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        $bill->status = ($fraudStatus == 'challenge') ? 'PENDING' : 'PAID';
                    }
                    break;
                case 'settlement':
                    $bill->status = 'PAID';
                    break;
                case 'pending':
                    $bill->status = 'PENDING';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $bill->status = 'CANCELLED';
                    break;
                default:
                    $bill->status = 'FAILED';
            }

            // Save basic payment details
            $bill->payment_type = $paymentType;
            $bill->transaction_id = $notificationBody['transaction_id'] ?? null;

            $bill->save();

            Log::info('Transaction updated successfully', [
                'order_id' => $orderId,
                'new_status' => $bill->status,
                'payment_type' => $bill->payment_type
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
