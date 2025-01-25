<?php

namespace App\Http\Controllers;

use App\Models\Seal;
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
}
