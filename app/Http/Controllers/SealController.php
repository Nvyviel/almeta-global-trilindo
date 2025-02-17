<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Bill;
use App\Models\Seal;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\support\facades\Log;
use App\Http\Controllers\Controller;

class SealController extends Controller
{

    public function createSeal()
    {
        return view('user.create-seal');
    }

    public function seal(Request $request)
    {
        $filter = $request->get('filter', 'all');

        // Buat query dasar
        $query = Seal::where('user_id', auth()->id());

        // Tambahkan filter jika bukan 'all'
        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        // Urutkan dan lakukan pagination di akhir
        $seals = $query->orderBy('created_at', 'desc')
            ->paginate(10);

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
}
