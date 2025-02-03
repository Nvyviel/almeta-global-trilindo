<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function listBill() 
    {
        return view('user.bill-of-lading');
    }
}
