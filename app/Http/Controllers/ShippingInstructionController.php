<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingInstructionController extends Controller
{
    public function showList()
    {
        return view('user.shipping-instruction');
    }

    public function requestSi()
    {
        return view('user.request-si');
    }
}
