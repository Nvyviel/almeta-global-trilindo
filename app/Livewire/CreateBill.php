<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\User;
use Livewire\Component;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingInstruction;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateBill extends Component
{
    use WithFileUploads;

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

    protected function generateUniqueBillId(): string
    {
        do {
            $randomPart = strtoupper(Str::random(7));
            $billId = "B{$randomPart}";
        } while (Bill::where('bill_id', $billId)->exists());

        return $billId;
    }

    public function createBill()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $shippingInstruction = ShippingInstruction::where('shipment_id', $this->shipment_id)
                ->where('container_id', $this->container_id)
                ->where('status', 'Approved')
                ->firstOrFail();

            $this->bill_id = $this->generateUniqueBillId();

            $shipment = Shipment::findOrFail($this->shipment_id);
            $container = Container::findOrFail($this->container_id);

            if ($this->uploadFile instanceof TemporaryUploadedFile) {
                $fileName = $this->bill_id . '.' . $this->uploadFile->getClientOriginalExtension();
                $filePath = $this->uploadFile->storeAs('bills', $fileName, 'public');
            } else {
                throw new \Exception('Invalid file upload');
            }

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
                'status' => 'Pending',
                'payment_term' => 'Port To Port',
                'document_price' => $document_price,
                'weight_rate' => $weight_rate,
                'grand_total' => $grand_total,
                'upload_file' => $filePath,
            ]);

            $this->cleanupOldUploads();
            
            DB::commit();
            session()->flash('success', 'Bill created successfully with ID: ' . $this->bill_id);
            $this->reset(['user_id', 'shipment_id', 'container_id', 'status', 'selectedData', 'uploadFile']);
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            session()->flash('error', 'Failed to create bill: ' . $e->getMessage());
            return redirect()->back();
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
