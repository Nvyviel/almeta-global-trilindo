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
        return view('user.show-list-seal');
    }

    public function seal(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $seals = Seal::where('user_id', auth()->id());

        if ($filter !== 'all') {
            $seals->where('status', $filter);
        }
        $seals = $seals->get();

        return view('user.seal', compact('seals'));
    }

    public function activitySeal()
    {
        $seals = Seal::with('user') // Eager load user relationship
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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

            // Get notification body from Midtrans
            $notificationBody = json_decode($request->getContent(), true);

            // Handle the notification
            $orderId = $notificationBody['order_id'];
            $transactionStatus = $notificationBody['transaction_status'];
            $fraudStatus = $notificationBody['fraud_status'] ?? null;
            $paymentType = $notificationBody['payment_type'];

            // Find the seal
            $seal = Seal::where('id_seal', $orderId)->first();

            if (!$seal) {
                Log::error('Seal not found for order: ' . $orderId);
                return response()->json(['error' => 'Order not found'], 404);
            }

            // Update seal status based on transaction status
            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        $seal->status = ($fraudStatus == 'challenge') ? 'payment_process' : 'success';
                    }
                    break;
                case 'settlement':
                    $seal->status = 'success';
                    break;
                case 'pending':
                    $seal->status = 'payment_process';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $seal->status = 'failed';
                    break;
            }

            $seal->save();

            // Return success response
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
