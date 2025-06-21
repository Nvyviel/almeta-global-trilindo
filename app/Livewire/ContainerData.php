<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Container;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ContainerData extends Component
{
    public $stuffing;
    public $ownership_container;
    public $load_type;
    public $container_type;
    public $quantity;
    public $commodity;
    public $weight;
    public $notes;
    public $is_danger = "No";
    public $shipment_id;
    public $user_id;

    protected $rules = [
        'stuffing' => 'required',
        'ownership_container' => 'required',
        'load_type' => 'required',
        'container_type' => 'required',
        'quantity' => 'required|numeric',
        'commodity' => 'required',
        'weight' => 'required|numeric',
        'notes' => 'nullable|string',
        'is_danger' => 'in:Yes,No',
        'shipment_id' => 'required|exists:shipments,id',
        'user_id' => 'required|exists:users,id',
    ];

    protected $messages = [
        'stuffing.required' => 'The stuffing field is required.',
        'ownership_container.required' => 'The ownership container field is required.',
        'load_type.required' => 'The load type field is required.',
        'container_type.required' => 'The container type field is required.',
        'quantity.required' => 'The quantity field is required.',
        'quantity.numeric' => 'The quantity must be a number.',
        'commodity.required' => 'The commodity field is required.',
        'weight.required' => 'The weight field is required.',
        'weight.numeric' => 'The weight must be a number.',
        'notes.string' => 'The notes must be a valid string.',
        'is_danger.in' => 'The is danger field must be either Yes or No.',
        'shipment_id.required' => 'The shipment ID is required.',
        'shipment_id.exists' => 'The selected shipment ID is invalid.',
        'user_id.required' => 'The user ID is required.',
        'user_id.exists' => 'The selected user ID is invalid.',
    ];

    public function mount(Request $request)
    {
        $this->is_danger = "No";
        $this->shipment_id = $request->input('shipment_id');
        $this->user_id = $request->input('user_id') ?? Auth::id();
    }

    public function updatedIsDanger($value)
    {
        $this->is_danger = $value ? 'Yes' : 'No';
    }

    public function generateUniqueOrderId()
    {
        do {
            $idOrder = 'RO' . strtoupper(Str::random(7));
        } while (Container::where('id_order', $idOrder)->exists());

        return $idOrder;
    }


    public function addContainer()
    {
        // Explicitly validate and store validation result
        $validated = $this->validate([
            'stuffing' => 'required',
            'ownership_container' => 'required',
            'load_type' => 'required',
            'container_type' => 'required',
            'quantity' => 'required|numeric',
            'commodity' => 'required',
            'weight' => 'required|numeric',
            'notes' => 'nullable|string',
            'is_danger' => 'in:Yes,No',
            'shipment_id' => 'required|exists:shipments,id',
            'user_id' => 'required|exists:users,id',
        ], [
            'stuffing.required' => 'The stuffing field is required.',
            'ownership_container.required' => 'The ownership container field is required.',
            'load_type.required' => 'The load type field is required.',
            'container_type.required' => 'The container type field is required.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.numeric' => 'The quantity must be a number.',
            'commodity.required' => 'The commodity field is required.',
            'weight.required' => 'The weight field is required.',
            'weight.numeric' => 'The weight must be a number.',
            'notes.string' => 'The notes must be a valid string.',
            'is_danger.in' => 'The is danger field must be either Yes or No.',
            'shipment_id.required' => 'The shipment ID is required.',
            'shipment_id.exists' => 'The selected shipment ID is invalid.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
        ]);
        
        try {
            // Generate unique id_order
            $validated['id_order'] = $this->generateUniqueOrderId();
            $validated['status'] = 'Requested';

            // Create container
            Container::create($validated);

            session()->flash('success', 'Container data created successfully!');
            return redirect()->route('release-order');
            
        } catch (\Exception $e) {
            Log::error('Error creating container: ' . $e->getMessage());
            session()->flash('error', 'Failed to create container. Please try again.');
        }
    }


    public function render(Request $request)
    {
        $shipmentId = $request->input('shipment_id');
        $userId = $request->input('user_id');
        return view('livewire.container-data', compact('shipmentId', 'userId'));
    }
}
