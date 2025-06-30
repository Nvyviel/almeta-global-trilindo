<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function createBill()
    {
        return view('user.bills.bills');
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

        return view('user.bills.list-bill', compact('bills'));
    }

    public function detailBill(Bill $bill)
    {
        $bill->load(['user', 'shipment', 'container']);

        $weightRate = ceil($bill->container->weight / 100) * 90000;

        $containerTotalRate = $bill->container->rate_per_container * $bill->container->quantity;

        $totalPrice = $bill->shipment->rate + $containerTotalRate + $weightRate + 250000;

        return view('user.bills.bill-detail', compact('bill', 'weightRate', 'containerTotalRate', 'totalPrice'));
    }
}
