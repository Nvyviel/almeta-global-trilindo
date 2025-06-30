<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Seal;
use Illuminate\Http\Request;
use Illuminate\support\facades\Log;
use App\Http\Controllers\Controller;

class SealController extends Controller
{

    public function createSeal()
    {
        return view('user.seals.create-seal');
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

        return view('user.seals.seal', compact('seals'));
    }
    
    public function activitySeal()
    {
        $seals = Seal::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.histories.activity-seal', compact('seals'));
    }

    public function addStock()
    {
        return view('admin.creators.stock-seal');
    }

    public function confirmationSeal($id)
    {
        $seal = Seal::where('id_seal', $id)->first();
        if (!$seal) {
            return redirect()->route('seal')->with('error', 'Seal tidak ditemukan');
        }
        return view('user.seals.confirmation-seal', compact('seal'));
    }
}
