<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\User;
use Livewire\Component;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Support\Str;
use App\Models\ShippingInstruction;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateBill extends Component
{
    public $user_id;
    public $shipment_id;
    public $container_id;
    public $status = 'Unpaid';
    public $bill_id;
    public $selectedData = null;
    public $uploadFile;
    
    public $users = [];
    public $shipments = [];
    public $containers = [];

    use WithFileUploads;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'shipment_id' => 'required|exists:shipments,id',
        'container_id' => 'required|exists:containers,id',
        'status' => 'required|in:Paid,Unpaid',
        'uploadFile' => 'required|file|mimes:pdf|max:10240'
    ];

    public function mount()
    {
        $this->users = User::select('id', 'company_name')->get();
    }

    public function cleanupOldUploads()
    {
        if ($this->uploadFile instanceof TemporaryUploadedFile) {
            $this->uploadFile->delete();
        }
    }

    public function updatedUploadFile()
    {
        $this->validate([
            'uploadFile' => 'file|mimes:pdf,jpg,jpeg,png|max:10240'
        ]);
    }

    public function updatedUserId($userId)
    {
        if ($userId) {
            $this->shipments = Shipment::whereHas('containers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->whereHas('shippingInstructions', function ($query) {
                $query->where('status', 'Approved');
            })
            ->select('id', 'vessel_name', 'from_city', 'to_city', 'rate', 'rate_per_container')
            ->distinct()
            ->get();
        } else {
            $this->shipments = [];
        }
        $this->shipment_id = null;
        $this->container_id = null;
        $this->selectedData = null;
    }

    public function updatedShipmentId($shipmentId)
    {
        if ($shipmentId) {
            $this->containers = Container::where('user_id', $this->user_id)
                ->whereHas('shippingInstructions', function ($query) use ($shipmentId) {
                    $query->where('shipment_id', $shipmentId)
                        ->where('status', 'Approved');
                })
                ->whereDoesntHave('bills') // Changed from 'bill' to 'bills'
                ->select('id', 'id_order', 'quantity')
                ->get();
        } else {
            $this->containers = [];
        }
        $this->container_id = null;
        $this->selectedData = null;
    }

    public function updatedContainerId($containerId)
    {
        if ($containerId) {
            $user = User::find($this->user_id);
            $shipment = Shipment::find($this->shipment_id);
            $container = Container::find($containerId);
            
            // Calculate rate_per_container multiplied by quantity
            $containerTotalRate = $shipment->rate_per_container * $container->quantity;
            
            // Calculate weight-based charge (1,000,000 per 100kg)
            $weightRate = ceil($container->weight / 100) * 90000;
            
            $totalPrice = $shipment->rate + $containerTotalRate + 250000 + $weightRate;
            
            $this->selectedData = [
                'company_name' => $user->company_name,
                'vessel_name' => $shipment->vessel_name,
                'route' => $shipment->from_city . ' -> ' . $shipment->to_city,
                'id_order' => $container->id_order,
                'total_price' => $totalPrice,
                'quantity' => $container->quantity,
                'rate_per_container' => $shipment->rate_per_container,
                'container_total_rate' => $containerTotalRate,
                'weight' => $container->weight,
                'weight_rate' => $weightRate,
            ];
        } else {
            $this->selectedData = null;
        }
    }

    protected function generateUniqueBillId(): string
    {
        do {
            $randomPart = strtoupper(Str::random(7));
            $billId = "BL - {$randomPart}";
        } while (Bill::where('bill_id', $billId)->exists());

        return $billId;
    }


    public function createBill()
    {
        $this->validate();

        try {
            $shippingInstruction = ShippingInstruction::where('shipment_id', $this->shipment_id)
                ->where('container_id', $this->container_id)
                ->where('status', 'Approved')
                ->firstOrFail();

            $this->bill_id = $this->generateUniqueBillId();

            $shipment = Shipment::find($this->shipment_id);
            $container = Container::find($this->container_id);

            // Handle file upload with better error handling
            if ($this->uploadFile instanceof TemporaryUploadedFile) {
                $fileName = $this->bill_id . '.' . $this->uploadFile->getClientOriginalExtension();
                $filePath = $this->uploadFile->storeAs('bills', $fileName, 'public');
            } else {
                throw new \Exception('Invalid file upload');
            }

            // Calculate all components
            $document_price = 250000;
            $container_total_rate = $shipment->rate_per_container * $container->quantity;
            $weight_rate = ceil($container->weight / 100) * 90000;
            $grand_total = $shipment->rate + $container_total_rate + $document_price + $weight_rate;

            $bill = Bill::create([
                'bill_id' => $this->bill_id,
                'user_id' => $this->user_id,
                'shipment_id' => $this->shipment_id,
                'container_id' => $this->container_id,
                'shipping_instruction_id' => $shippingInstruction->id,
                'status' => $this->status,
                'payment_term' => 'Port To Port',
                'document_price' => $document_price,
                'weight_rate' => $weight_rate,
                'grand_total' => $grand_total,
                'upload_file' => $filePath,
            ]);

            $this->cleanupOldUploads();
            session()->flash('success', 'Bill created successfully with ID: ' . $this->bill_id);
            $this->reset(['user_id', 'shipment_id', 'container_id', 'status', 'selectedData', 'uploadFile']);
        } catch (\Exception $e) {
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            session()->flash('error', 'Failed to create bill: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-bill', [
            'users' => $this->users,
            'shipments' => $this->shipments,
            'containers' => $this->containers,
            'selectedData' => $this->selectedData,
        ]);
    }
}