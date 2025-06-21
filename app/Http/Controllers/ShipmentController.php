<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShipmentController extends Controller
{
    public function create()
    {
        return view('admin.creators.create-shipment');
    }

    public function addschedule(Request $request)
    {
        return view("admin.landings.dashboard-admin");
    }


    // app/Http/Controllers/ShipmentController.php

    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        $cities = [
            'surabaya' => 'Surabaya',
            'pontianak' => 'Pontianak',
            'semarang' => 'Semarang',
            'banjarmasin' => 'Banjarmasin',
            'bandung' => 'Bandung',
            'jakarta' => 'Jakarta'
        ];

        return view('admin.edits.edit-shipment', compact('shipment', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from_city' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
            'to_city' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
            'vessel_name' => 'required|string',
            'closing_cargo' => 'required|date',
            'etb' => 'required|date',
            'etd' => 'required|date',
            'eta' => 'required|date',
            'rate' => 'required|numeric|min:0' // Add validation for rate
        ]);

        $shipment = Shipment::findOrFail($id);
        $shipment->update($request->all());

        return redirect()->route('create-shipment')
        ->with('success', 'Data shipment berhasil diperbarui');
    }

    public function filtering(Request $request)
    {
        $pod = $request->input('pod');
        $pol = $request->input('pol');

        if (empty($pod) || empty($pol)) {
            return view('user.dashboard', ['shipments' => collect()]);
        }

        $shipments = Shipment::where('to_city', $pod)
            ->where('from_city', $pol)
            ->get();

        return view('user.dashboard', compact('shipments'));
    }

    public function guestFiltering(Request $request)
    {
        $pod = $request->input('pod');
        $pol = $request->input('pol');

        if (empty($pod) || empty($pol)) {
            return view('user.landings.index', ['shipments' => collect()]);
        }

        $shipments = Shipment::where('to_city', $pod)
        ->where('from_city', $pol)
        ->get();

        return view('user.landings.index', compact('shipments'));
    }

    public function approvalRo(Request $request)
{
    // Ambil filter dari request
    $selectedVessel = $request->query('selectedVessel');
    $search = $request->query('search');
    $orderId = $request->query('order_id'); // Tambahkan filter untuk order_id

    // Query awal
    $name_ship = Container::with([
        'shipment_container',
        'user:id,company_name',
    ]);

    // Filter berdasarkan kapal yang dipilih
    if ($selectedVessel) {
        $name_ship->whereHas('shipment_container', function ($query) use ($selectedVessel) {
            $query->where('vessel_name', $selectedVessel);
        });
    }

    // Filter berdasarkan pencarian (commodity atau company_name)
    if ($search) {
        $name_ship->where(function ($query) use ($search) {
            $query->where('commodity', 'LIKE', "%$search%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('company_name', 'LIKE', "%$search%");
                });
        });
    }

    if ($orderId) {
        $name_ship->where('id_order', 'LIKE', "%$orderId%");
    }

    // Eksekusi query
    $name_ship = $name_ship->get();

    $availableVessel = Shipment::pluck('vessel_name');

    return view('admin.approvals.approval-ro', compact('name_ship', 'availableVessel'));
}

    public function uploadRoPdf(Request $request, $id)
    {
        $request->validate([
            'pdf_ro' => 'required|mimes:pdf|max:2048' // Validates that the file is a PDF and not larger than 2MB
        ]);

        $container = Container::findOrFail($id);

        if ($request->hasFile('pdf_ro')) {
            // Generate unique filename
            $filename = 'ro_' . $container->id_order . '_' . time() . '.pdf';

            // Store the file
            $path = $request->file('pdf_ro')->storeAs('release-orders', $filename, 'public');

            // Update container record
            $container->update([
                'pdf_ro' => $path
            ]);

            return redirect()->back()->with('success', 'Release Order PDF has been uploaded successfully');
        }

        return redirect()->back()->with('error', 'No file was uploaded');
    }

    public function approve($id)
    {
        $container = Container::findOrFail($id);

        request()->validate([
            'pdf_ro' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        if (request()->hasFile('pdf_ro')) {
            // Generate unique filename
            $filename = 'ro_' . $container->id_order . '_' . time() . '.pdf';

            // Store the file
            $path = request()->file('pdf_ro')->storeAs('release-orders', $filename, 'public');

            // Update container with file path and status
            $container->update([
                'pdf_ro' => $path,
                'status' => 'Approved'
            ]);

            return redirect()->back()->with('success', 'Release Order has been approved and document uploaded successfully');
        }

        return redirect()->back()->with('error', 'Please upload the Release Order PDF before approving');
    }

    public function cancel($id)
    {
        $container = Container::findOrFail($id);
        
        // // Check authorization
        // if (!auth()->user()->can('cancel', $container)) {
        //     abort(403);
        // }
        
        $container->update([
            'status' => 'Canceled'
        ]);
        
        return redirect()->back()->with('success', 'Container has been canceled successfully');
    }

    
}
