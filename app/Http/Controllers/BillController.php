<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Bill;
use Midtrans\Config;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function createBill() 
    {
        return view('user.bill-of-lading');
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
                'order_id' => 'BILL-' . $bill->id,
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
}
