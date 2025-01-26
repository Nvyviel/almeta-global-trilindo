<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Container;
use App\Models\Shipment;
use App\Models\ShippingInstruction;

class ShippingInstructionData extends Component
{
    public $shipment_id;
    public $container_id;

    // Arrays to hold multiple container details
    public $container_numbers = [];
    public $seal_numbers = [];
    public $container_notes = [];

    // Arrays for dropdowns
    public $shipments = [];
    public $containers = [];

    public function mount()
    {
        // Load shipments for dropdown
        $this->shipments = Shipment::select('id', 'vessel_name')->get();
    }

    // When shipment is selected, load its containers
    public function updatedShipmentId($shipmentId)
    {
        // Reset all dependent fields when shipment changes
        $this->reset([
            'container_id',
            'container_numbers',
            'seal_numbers',
            'container_notes',
            'containers'
        ]);

        // Load containers associated with the selected shipment
        $this->containers = Container::where('shipment_id', $shipmentId)->get();
    }

    // When container is selected, automatically generate input fields based on its quantity
    public function updatedContainerId($containerId)
    {
        // Find the selected container
        $container = Container::findOrFail($containerId);

        // Automatically create input fields based on container quantity
        $this->container_numbers = array_fill(0, $container->quantity, '');
        $this->seal_numbers = array_fill(0, $container->quantity, '');
        $this->container_notes = array_fill(0, $container->quantity, '');
    }

    // Validation rules
    protected function rules()
    {
        $rules = [
            'shipment_id' => 'required|exists:shipments,id',
            'container_id' => 'required|exists:containers,id',
        ];

        // Dynamically add validation for container numbers, seal numbers, and notes
        foreach (range(0, count($this->container_numbers) - 1) as $index) {
            $rules["container_numbers.$index"] = 'required|string|max:255';
            $rules["seal_numbers.$index"] = 'required|string|max:255';
            $rules["container_notes.$index"] = 'nullable|string|max:255';
        }

        return $rules;
    }

    // Create shipping instructions
    public function store()
    {
        // Validate first
        $validatedData = $this->validate();

        // Ensure arrays are not empty
        if (empty($this->container_numbers)) {
            $this->addError('container_id', 'Please select a container first.');
            return;
        }

        try {
            // Create multiple shipping instructions based on quantity
            foreach (range(0, count($this->container_numbers) - 1) as $index) {
                ShippingInstruction::create([
                    'shipment_id' => $this->shipment_id,
                    'container_id' => $this->container_id,
                    'no_container' => $this->container_numbers[$index],
                    'no_seal' => $this->seal_numbers[$index],
                    'note' => $this->container_notes[$index] ?? null
                ]);
            }

            // Reset form
            $this->reset([
                'shipment_id',
                'container_id',
                'container_numbers',
                'seal_numbers',
                'container_notes'
            ]);

            // Show success notification
            session()->flash('success', 'Shipping instructions created successfully');
        } catch (\Exception $e) {
            // Show error notification
            session()->flash('error', 'Failed to create shipping instructions: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.shipping-instruction-data');
    }
}