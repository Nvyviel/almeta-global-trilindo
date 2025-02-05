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

    // Jika parameter yang dikirim adalah 'filter', gunakan itu
    if ($request->has('filter') && $request->filter != '') {
        // Jika filter bukan 'all', tambahkan kondisi filter status
        if ($request->filter !== 'all') {
            $query->whereHas('shippingInstructions', function ($q) use ($request) {
                // Pastikan format sesuai, misalnya dengan strtolower()
                $q->where('status', $request->filter);
            });
        }
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

    public function detailSi($id)
    {
        $dataSi = ShippingInstruction::with('user', 'container.shipment_container', 'shipment', 'consignee')
                    ->findOrFail($id);
        return view('admin.approval-si-detail', compact('dataSi'));
    }


    public function approvedSi($id)
    {
        $shippingInstructions = ShippingInstruction::findOrFail($id);

        // Find all shipping instructions with the same order ID
        $sameOrderInstructions = ShippingInstruction::whereHas('container', function($query) use ($shippingInstructions) {
            $query->where('id_order', $shippingInstructions->container->id_order);
        })->get();

        // Update all related shipping instructions
        foreach ($sameOrderInstructions as $instruction) {
            $instruction->update([
                'status' => 'Approved'
            ]);
        }

        return redirect()->back()->with('success', 'Shipping Instruction has been Approved successfully');
    }

    public function rejectedSi($id)
    {
        $shippingInstructions = ShippingInstruction::findOrFail($id);

        // Find all shipping instructions with the same order ID
        $sameIdSi = ShippingInstruction::whereHas('container', function($query) use ($shippingInstructions) {
            $query->where('id_order', $shippingInstructions->container->id_order);
        })->get();

        // Update all related shipping instructions
        foreach ($sameIdSi as $instruction) {
            $instruction->update([
                'status' => 'Rejected'
            ]);
        }

        return redirect()->back()->with('success', 'Shipping Instruction has been Rejected successfully');
    }
}
