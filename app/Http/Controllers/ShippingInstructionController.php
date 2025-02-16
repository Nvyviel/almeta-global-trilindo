<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Models\ShippingInstruction;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShippingInstructionController extends Controller
{
    public function showList(Request $request)
    {
        $query = Container::with(['shipment_container', 'shippingInstructions'])
            ->whereHas('shippingInstructions')
            ->where('user_id', auth()->id())
            ->orderByDesc('id');

        if ($request->has('filter') && $request->filter != '') {
            if ($request->filter !== 'all') {
                $query->whereHas('shippingInstructions', function ($q) use ($request) {
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
        try {
            // Get filters from request
            $selectedVessel = $request->query('selectedVessel');
            $search = $request->query('search');

            // Initial query with explicit select
            $query = ShippingInstruction::select('shipping_instructions.*')
                ->with([
                    'user',
                    'container.shipment_container',
                    'shipment',
                    'consignee'
                ]);

            if ($selectedVessel) {
                $query->whereHas('container.shipment_container', function ($q) use ($selectedVessel) {
                    $q->where('vessel_name', $selectedVessel);
                });
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('container', function ($subQ) use ($search) {
                        $subQ->where('commodity', 'LIKE', "%$search%");
                    })
                        ->orWhereHas('user', function ($subQ) use ($search) {
                            $subQ->where('company_name', 'LIKE', "%$search%");
                        });
                });
            }

            $query->where('status', 'Requested');

            $availableVessel = Shipment::pluck('vessel_name');
            $shippingInstructions = $query->paginate(10);

            return view('admin.approval-si', compact('shippingInstructions', 'availableVessel'));
        } catch (\Exception $e) {
            Log::error('Error in approvalSi:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An error occurred while loading shipping instructions.');
        }
    }

    public function detailSi($id)
    {
        $dataSi = ShippingInstruction::with('user', 'container.shipment_container', 'shipment', 'consignee')
            ->findOrFail($id);
        return view('admin.approval-si-detail', compact('dataSi'));
    }

    public function uploadSiFile(Request $request, $id)
    {
        // SEMENTARA ADA TOMBOL UNTUK UPLOAD FILE. NEXT TOMBOL UPLOAD JADI 1 SAMA TOMBOL APPROVE ALL
        try {
            // Validate the request
            $request->validate([
                'si_file' => 'required|mimes:pdf|max:10240'
            ]);

            // Find the initial shipping instruction
            $shippingInstruction = ShippingInstruction::findOrFail($id);

            // Get the container's order ID
            $orderId = $shippingInstruction->container->id_order;

            // Find all shipping instructions with the same order ID
            $relatedInstructions = ShippingInstruction::whereHas('container', function ($query) use ($orderId) {
                $query->where('id_order', $orderId);
            })->get();

            if ($request->hasFile('si_file')) {
                // Generate unique filename
                $fileName = 'SI_' . time() . '_' . $orderId . '.' . $request->si_file->extension();

                // Store the file
                $path = $request->file('si_file')->storeAs('shipping-instructions', $fileName, 'public');

                // Delete old files if they exist
                foreach ($relatedInstructions as $instruction) {
                    if ($instruction['upload_file_si']) {
                        Storage::disk('public')->delete($instruction['upload_file_si']);
                    }
                }

                // Update all related shipping instructions with the new file path
                foreach ($relatedInstructions as $instruction) {
                    $instruction->update([
                        'upload_file_si' => $path
                    ]);
                }

                return redirect()->back()->with('success', 'Shipping Instruction file has been uploaded successfully');
            }

            return redirect()->back()->with('error', 'No file was uploaded');
        } catch (\Exception $e) {
            Log::error('Error in uploadSiFile:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while uploading the file');
        }
    }

    public function approvedSi(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'si_file' => 'required|mimes:pdf|max:10240', // max 10MB
        ],
            [
                'si_file.required' => 'File Shipping Instruction harus diupload untuk melakukan approval'
            ]
        );

        try {
            // Find the initial shipping instruction
            $shippingInstruction = ShippingInstruction::findOrFail($id);

            // Get the container's order ID
            $orderId = $shippingInstruction->container->id_order;

            // Find all shipping instructions with the same order ID
            $relatedInstructions = ShippingInstruction::whereHas('container', function ($query) use ($orderId) {
                $query->where('id_order', $orderId);
            })->get();

            if ($request->hasFile('si_file')) {
                // Generate unique filename using order ID
                $fileName = 'SI_' . time() . '_' . $orderId . '.pdf';

                // Store the file
                $path = $request->file('si_file')->storeAs(
                    'shipping-instructions',
                    $fileName,
                    'public'
                );

                // Delete old files if they exist
                foreach ($relatedInstructions as $instruction) {
                    if ($instruction->upload_file_si) {
                        Storage::disk('public')->delete('shipping-instructions/' . $instruction->upload_file_si);
                    }
                }

                // Update all related shipping instructions
                foreach ($relatedInstructions as $instruction) {
                    $instruction->update([
                        'upload_file_si' => $fileName,
                        'status' => 'Approved'
                    ]);
                }

                return redirect()->back()->with('success', 'Semua Shipping Instruction dengan ID order yang sama berhasil diapprove.');
            }

            return redirect()->back()
                ->with('error', 'File Shipping Instruction wajib diupload untuk melakukan approval.')
                ->withInput();
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('SI Approval Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat melakukan approval shipping instruction.')
                ->withInput();
        }
    }

    public function rejectedSi($id)
    {
        $shippingInstructions = ShippingInstruction::findOrFail($id);

        // Find all shipping instructions with the same order ID
        $sameIdSi = ShippingInstruction::whereHas('container', function ($query) use ($shippingInstructions) {
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

    public function historySi()
    {
        $instructions = ShippingInstruction::with('consignee')->get();
        return view('admin.history-si', compact('instructions'));
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $instruction = ShippingInstruction::findOrFail($id);
    //     $newStatus = $instruction->status === 'Approved' ? 'Rejected' : 'Approved';
    //     $instruction->update(['status' => $newStatus]);

    //     return response()->json([
    //         'success' => true,
    //         'newStatus' => $newStatus
    //     ]);
    // }
}
