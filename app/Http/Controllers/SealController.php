<?php

namespace App\Http\Controllers;

use Illuminate\support\facades\Log;
use Midtrans\Snap;
use App\Models\Seal;
use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SealController extends Controller
{

    public function showListSeal()
    {
        return view('user.create-seal');
    }

    public function seal(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $seals = Seal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')->paginate(10);

        if ($filter !== 'all') {
            $seals->where('status', $filter);
        }

        return view('user.seal', compact('seals'));
    }

    public function activitySeal()
    {
        $seals = Seal::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.activity-seal', compact('seals'));
    }

    public function addStock()
    {
        return view('admin.stock-seal');
    }


    public function getSnapToken(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Silakan login untuk melakukan transaksi.'], 401);
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $seal = Seal::find($id);

        $params = [
            'transaction_details' => [
                'order_id' => $seal->id_seal,
                'gross_amount' => $seal->total_price,
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

            // Cek apakah order ditemukan
            $seal = Seal::where('id_seal', $orderId)->first();
            if (!$seal) {
                Log::error('Seal not found for order: ' . $orderId);
                return response()->json(['error' => 'Order not found'], 404);
            }

            Log::info('Processing transaction', ['order_id' => $orderId, 'status' => $transactionStatus]);

            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        $seal->status = ($fraudStatus == 'challenge') ? 'payment_process' : 'success';
                    }
                    break;
                case 'settlement':
                    $seal->status = 'Success';
                    break;
                case 'pending':
                    $seal->status = 'Payment Process';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $seal->status = 'Canceled';
                    break;
            }

            $seal->save();

            Log::info('Transaction updated successfully', ['order_id' => $orderId, 'new_status' => $seal->status]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
