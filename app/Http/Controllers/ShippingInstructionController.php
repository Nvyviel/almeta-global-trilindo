<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;
use App\Models\ShippingInstruction;
use App\Http\Controllers\Controller;

class ShippingInstructionController extends Controller
{
    public function showList(Request $request)
    {
        $query = Container::with('shipment_container')
        ->whereHas('shippingInstructions');

        if ($request->has('status') && $request->status != '') {
            $query->whereHas('shippingInstructions', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $containers = $query->paginate(10);
        return view('user.shipping-instruction', compact('containers'));
    }

    public function showDetail($container)
    {
        $container = Container::with(['shipment_container', 'shippingInstructions'])
        ->findOrFail($container);

        return view('user.shipping-instruction-detail', compact('container'));
    }

    public function requestSi()
    {
        return view('user.request-si');
    }

    public function approvalSi(Request $request)
    {
        $query = ShippingInstruction::with(['user', 'container', 'shipment', 'consignee']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'Requested');
        }

        $shippingInstructions = $query->paginate(10);
        return view('admin.approval-si', compact('shippingInstructions'));
    }

    public function detailSi()
    {
        return view('admin.approval-si-detail');
    }

    public function approvedSi($id)
    {
        $shippingInstructions = ShippingInstruction::findOrFail($id);

        $shippingInstructions->update([
            'status' => 'Approved'
        ]);

        return redirect()->back()->with('success', 'Shipping Instruction has been Approved successfully');
    }

    public function rejectedSi($id)
    {
        $shippingInstructions = ShippingInstruction::findOrFail($id);

        $shippingInstructions->update([
            'status' => 'Rejected'
        ]);

        return redirect()->back()->with('success', 'Shipping Instruction has been Rejected successfully');
    }
}
