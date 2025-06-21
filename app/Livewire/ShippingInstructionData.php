<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Container;
use App\Models\Shipment;
use App\Models\ShippingInstruction;
use App\Models\Consignee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShippingInstructionData extends Component
{
    public $shipment_id;
    public $container_id;
    public $consignee_id;
    public $container_numbers = [];
    public $seal_numbers = [];
    public $container_notes = [];
    public $shipments = [];
    public $containers = [];
    public $consignees = [];
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadAvailableShipments();
        $this->loadConsignees();
    }

    protected function generateInstructionId()
    {
        do {
            // Generate 7 random alphanumeric characters
            $randomPart = strtoupper(Str::random(7));
            $instructionId = "SI" . $randomPart;
        
            $exists = ShippingInstruction::where('instructions_id', $instructionId)->exists();
        } while ($exists);

        return $instructionId;
    }

    protected function loadConsignees()
    {
        $this->consignees = Consignee::select(
            'id',
            'name_consignee',
            'industry',
            'city',
            'email',
            'phone_number',
            'consignee_address'
        )
        ->where('user_id', $this->user->id)
        ->get();
    }

    protected function loadAvailableShipments()
    {
        $shipmentsWithAvailableContainers = Shipment::whereHas('containers', function ($query) {
            $query->where('status', 'Approved')
                ->whereNotIn('id', function ($subQuery) {
                    $subQuery->select('container_id')
                        ->from('shipping_instructions')
                        ->groupBy('container_id');
                });
        })->select('id', 'vessel_name')->get();

        $this->shipments = $shipmentsWithAvailableContainers;

        if ($this->shipment_id && !$shipmentsWithAvailableContainers->contains('id', $this->shipment_id)) {
            $this->reset([
                'shipment_id',
                'container_id',
                'consignee_id',
                'container_numbers',
                'seal_numbers',
                'container_notes'
            ]);
        }
    }

    public function updatedShipmentId($shipmentId)
    {
        $this->reset([
            'container_id',
            'container_numbers',
            'seal_numbers',
            'container_notes',
            'containers'
        ]);

        if ($shipmentId) {
            $this->containers = Container::where('shipment_id', $shipmentId)
                ->where('status', 'Approved')
                ->whereNotIn('id', function ($query) {
                    $query->select('container_id')
                        ->from('shipping_instructions')
                        ->groupBy('container_id');
                })->get();

            if ($this->containers->isEmpty()) {
                $this->shipment_id = null;
                $this->containers = [];
                session()->flash('info', 'No available approved containers for this shipment.');
            }
        }
    }

    public function updatedContainerId($containerId)
    {
        if ($containerId) {
            $container = Container::where('id', $containerId)
                ->where('status', 'Approved')
                ->firstOrFail();

            $this->container_numbers = array_fill(0, $container->quantity, '');
            $this->seal_numbers = array_fill(0, $container->quantity, '');
            $this->container_notes = array_fill(0, $container->quantity, '');
        }
    }

    protected function rules()
    {
        $rules = [
            'shipment_id' => 'required|exists:shipments,id',
            'container_id' => [
                'required',
                'exists:containers,id',
                function ($attribute, $value, $fail) {
                    $container = Container::find($value);
                    if ($container && $container->status !== 'Approved') {
                        $fail('The selected container must be approved.');
                    }
                },
            ],
            'consignee_id' => 'required|exists:consignees,id',
        ];

        foreach (range(0, count($this->container_numbers) - 1) as $index) {
            $rules["container_numbers.$index"] = 'required|string|max:255';
            $rules["seal_numbers.$index"] = 'required|string|max:255';
            $rules["container_notes.$index"] = 'nullable|string|max:255';
        }

        return $rules;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if (empty($this->container_numbers)) {
            $this->addError('container_id', 'Please select a container first.');
            return;
        }

        $container = Container::find($this->container_id);
        if ($container->status !== 'Approved') {
            $this->addError('container_id', 'Only approved containers can be processed.');
            return;
        }

        try {
            foreach (range(0, count($this->container_numbers) - 1) as $index) {
                ShippingInstruction::create([
                    'instructions_id' => $this->generateInstructionId(),
                    'user_id' => $this->user->id,
                    'shipment_id' => $this->shipment_id,
                    'container_id' => $this->container_id,
                    'consignee_id' => $this->consignee_id,
                    'no_container' => $this->container_numbers[$index],
                    'no_seal' => $this->seal_numbers[$index],
                    'note' => $this->container_notes[$index] ?? null,
                    'status' => 'Requested'
                ]);
            }

            $this->loadAvailableShipments();

            $this->reset([
                'shipment_id',
                'container_id',
                'consignee_id',
                'container_numbers',
                'seal_numbers',
                'container_notes'
            ]);

            session()->flash('success', 'Shipping instructions created successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create shipping instructions: ' . $e->getMessage());
        }
        return redirect()->route('shipping-instruction');
    }

    public function render()
    {
        
        return view('livewire.shipping-instruction-data');
    }
}