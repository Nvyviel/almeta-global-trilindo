<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seal;
use App\Models\Bill;

class PaymentController extends Controller
{
    public function calculateProfits()
    {
        // Calculate Seal Profit (from successful seals)
        $sealProfit = Seal::where('status', 'Success')
            ->sum('total_price');

        // Calculate Ship Profit (from paid bills)
        $shipProfit = Bill::where('status', 'Paid')
            ->sum('grand_total');

        // Calculate Total Profit
        $totalProfit = $sealProfit + $shipProfit;

        return [
            'total_profit' => $totalProfit,
            'ship_profit' => $shipProfit,
            'seal_profit' => $sealProfit
        ];
    }

    // Method to format currency (helper function)
    public static function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
