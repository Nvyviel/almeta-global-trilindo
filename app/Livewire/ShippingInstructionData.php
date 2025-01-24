<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Container;
use App\Models\ShippingInstruction;
// use WireUi\Traits\Actions;

class ShippingInstructionData extends Component
{
    // use Actions;
    public $container_id;
    public $no_container;
    public $no_seal;
    public $note;

    // Array of available containers for dropdown
    public $containers = [];

    public function mount()
    {
        // Load containers for dropdown
        $this->containers = Container::select('id', 'shipment_id')->get();
    }

    // Validation rules
    protected function rules()
    {
        return [
            'container_id' => 'required|exists:containers,id',
            'no_container' => 'required|string|max:255',
            'no_seal' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
        ];
    }

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Create shipping instruction
    public function store()
    {
        $validatedData = $this->validate();

        try {
            ShippingInstruction::create($validatedData);

            // Reset form
            $this->reset(['container_id', 'no_container', 'no_seal', 'note']);

            // Show success notification
            $this->notification()->success(
                $title = 'Success!',
                $description = 'Shipping instruction created successfully'
            );
        } catch (\Exception $e) {
            // Show error notification
            $this->notification()->error(
                $title = 'Error!',
                $description = 'Failed to create shipping instruction'
            );
        }
    }

    public function render()
    {
        return view('livewire.shipping-instruction-data');
    }
}
