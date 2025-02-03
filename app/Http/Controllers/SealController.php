<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Midtrans\Snap;
use Midtrans\Config;

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

    public function transaction(Request $request, $id)
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melakukan transaksi.');
        }

        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $seal = Seal::find($id);


        // Persiapkan parameter transaksi
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
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }

        return view('user.seal', compact('snapToken'))->with('seal', collect([$seal]));
    }



    public function handleCallback(Request $request)
    {
        $notif = $request->input('notification');

        error_log($notif);

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {

            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $seals = Seal::where('id', $orderId)->first();
                    $seals->status = 'payment_process';
                    $seals->save();
                } else {
                    $seals = Seal::where('id', $orderId)->first();
                    $seals->status = 'success';
                    $seals->save();
                }
            }
        } else if ($transaction == 'settlement') {
            $seals = Seal::where('id', $orderId)->first();
            $seals->status = 'success';
            $seals->save();
        } else if ($transaction == 'pending') {
            $seals = Seal::where('id', $orderId)->first();
            $seals->status = 'payment_process';
            $seals->save();
        } else if ($transaction == 'deny') {
            $seals = Seal::where('id', $orderId)->first();
            $seals->status = 'payment_process';
            $seals->save();
        } else if ($transaction == 'expire') {
            $seals = Seal::where('id', $orderId)->first();
            $seals->status = 'payment_process';
            $seals->save();
        } else if ($transaction == 'cancel') {

            if ($fraud == 'challenge') {
                $seals = Seal::where('id', $orderId)->first();
                $seals->status = 'payment_process';
                $seals->save();
            } else {
                $seals = Seal::where('id', $orderId)->first();
                $seals->status = 'payment_process';
                $seals->save();
            }
        }

        return redirect()->route('seal');
    }
}
