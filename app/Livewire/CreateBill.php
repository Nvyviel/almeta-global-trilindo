<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bill;
use App\Models\User;
use App\Models\Shipment;
use App\Models\Container;
use App\Models\ShippingInstruction;
use Illuminate\Support\Str;

class CreateBill extends Component
{
    // Public properties for form binding
    public $user_id;
    public $shipment_id;
    public $container_id;
    public $status = 'Unpaid';
    public $bill_id;

    // Dropdown options
    public $users = [];
    public $shipments = [];
    public $containers = [];

    // Validation rules
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'shipment_id' => 'required|exists:shipments,id',
        'container_id' => 'required|exists:containers,id',
        'status' => 'required|in:Paid,Unpaid',
    ];

    // Lifecycle hook to load initial data
    public function mount()
    {
        // Load shipments that have at least one approved shipping instruction
        $this->shipments = Shipment::whereHas('shippingInstructions', function ($query) {
            $query->where('status', 'Approved');
        })->get();
    }

    // Update containers based on selected shipment with approved shipping instructions
    public function updatedShipmentId($shipmentId)
    {
        // Get containers for this shipment that have an approved shipping instruction
        $this->containers = Container::whereHas('shippingInstructions', function ($query) use ($shipmentId) {
            $query->where('shipment_id', $shipmentId)
                ->where('status', 'Approved');
        })->get();

        $this->container_id = null;
        $this->user_id = null;
    }

    // Update user based on selected container
    public function updatedContainerId($containerId)
    {
        if ($containerId) {
            $container = Container::find($containerId);
            $this->user_id = $container->user_id;
        }
    }

    // Generate unique bill ID
    protected function generateUniqueBillId(): string
    {
        do {
            $shipment = Shipment::find($this->shipment_id);
            $container = Container::find($this->container_id);

            $prefix = strtoupper(substr($shipment->from_city, 0, 3));
            $suffix = strtoupper(substr($container->container_type, 0, 3));
            $randomPart = Str::random(4);

            $billId = "{$prefix}-{$suffix}-{$randomPart}";
        } while (Bill::where('bill_id', $billId)->exists());

        return $billId;
    }

    // Create bill
    public function createBill()
    {
        // Validate input
        $this->validate();

        try {
            // Verify there's an approved shipping instruction for this shipment and container
            $shippingInstruction = ShippingInstruction::where('shipment_id', $this->shipment_id)
                ->where('container_id', $this->container_id)
                ->where('status', 'Approved')
                ->firstOrFail();

            // Generate unique bill ID
            $this->bill_id = $this->generateUniqueBillId();

            // Create bill
            $bill = Bill::create([
                'bill_id' => $this->bill_id,
                'user_id' => $this->user_id,
                'shipment_id' => $this->shipment_id,
                'container_id' => $this->container_id,
                'shipping_instruction_id' => $shippingInstruction->id,
                'status' => $this->status,
                'payment_term' => 'Port To Port'
            ]);

            // Flash success message
            session()->flash('success', 'Bill created successfully with ID: ' . $this->bill_id);

            // Reset form
            $this->reset(['shipment_id', 'container_id', 'user_id', 'status']);
        } catch (\Exception $e) {
            // Flash error message
            session()->flash('error', 'Failed to create bill: ' . $e->getMessage());
        }
    }

    // Render the Livewire component
    public function render()
    {
        return view('livewire.create-bill', [
            'shipments' => $this->shipments,
            'containers' => $this->containers,
        ]);
    }
}
