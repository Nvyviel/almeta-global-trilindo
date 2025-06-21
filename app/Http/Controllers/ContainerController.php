<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    public function booking(Request $request)
    {
        $shipmentId = $request->input('shipment_id');
        return view('user.shipments.booking', compact('shipmentId'));
    }

    public function createNew(Request $request)
    {
        return view('user.shipments.booking');
    }


    public function showDetail($id)
    {
        $user = auth()->user();

        if ($user->is_admin) {
            $container = Container::findOrFail($id);
        } else {
            $container = $user->container()->where('id', $id)->firstOrFail();
        }

        return view('user.shipments.show-release-order', compact('container'));
    }


    public function releaseOrder(Request $request)
    {
        $query = auth()->user()->container()->with('shipment_container')->orderBy('created_at', 'desc');
        
        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('status', $request->filter);
        }

        $container = $query->get();
        return view('user.shipments.release-order', compact('container'));
    }



    public function historyRo()
    {
        $containers = Container::all();

        return view('admin.histories.history-ro', compact('containers'));
    }
}
