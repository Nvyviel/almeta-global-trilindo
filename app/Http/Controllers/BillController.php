<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function createBill() 
    {
        return view('user.bill-of-lading');
    }
    // UNSOLVED ERROR

    public function listBill()
    {
        $bills = Bill::with(['user', 'shipment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
}
