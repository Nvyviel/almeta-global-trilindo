<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;
use App\Models\StockSeal;
use Livewire\Attributes\On;
use Midtrans\Config;
use Midtrans\Snap;

class OrderSeal extends Component
{
    public $pickup_point = 'surabaya';
    public $quantity = 1;
    public $price = 100000;
    public $totalPrice = [];
    public $availableStock = 0;
    public $snapToken;
    public $seal;

    protected $rules = [
        'pickup_point' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
        'quantity' => 'required|integer|min:1'
    ];

    public function updatedQuantity($value)
    {
        if ($value < 1) {
            $this->quantity = 1;
            $value = 1;
        }

        if ($value > $this->availableStock) {
            $this->quantity = $this->availableStock;
            $value = $this->availableStock;
        }

        $this->totalPrice = $value * $this->price;
    }

    public function mount()
    {
        $this->calculateAvailableStock();
        $this->totalPrice = $this->quantity * $this->price;
        $this->setupMidtransConfig();
    }

    private function setupMidtransConfig()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    #[On('success')]
    public function calculateAvailableStock()
    {
        $this->availableStock = StockSeal::sum('stock');
    }

    public function calculateTotalPrice()
    {
        $this->totalPrice = $this->quantity * $this->price;
    }

    public function createSeal()
    {
        $this->validate();

        try {
            if ($this->quantity > $this->availableStock) {
                session()->flash('error', 'Requested quantity exceeds available stock!');
                return redirect()->route('showListSeal');
            }

            $this->seal = Seal::create([
                'user_id' => auth()->id(),
                'id_seal' => Seal::generateIdSeal(),
                'pickup_point' => $this->pickup_point,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'total_price' => $this->totalPrice,
                'status' => 'Payment Proccess'
            ]);

            $this->reduceStock($this->quantity);
            $this->initiateMidtransPayment();
        } catch (\Exception $e) {
            $this->dispatch('purchaseError', $e->getMessage());
            session()->flash('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    private function initiateMidtransPayment()
    {
        try {
            $transactionDetails = [
                'order_id' => 'SEAL-' . $this->seal->id . '-' . time(),
                'gross_amount' => (int) $this->totalPrice
            ];

            $customerDetails = [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ];

            $itemDetails = [
                [
                    'id' => $this->seal->id_seal,
                    'price' => $this->price,
                    'quantity' => $this->quantity,
                    'name' => 'Seal from ' . $this->pickup_point,
                ]
            ];

            $midtransParams = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails,
            ];

            $this->snapToken = Snap::getSnapToken($midtransParams);

            $this->dispatch('order-success');
            $this->dispatch('showPaymentModal', $this->snapToken);
        } catch (\Exception $e) {
            // Rollback the order if payment initiation fails
            if ($this->seal) {
                $this->seal->delete();
                $this->restoreStock($this->quantity);
            }

            $this->dispatch('purchaseError', $e->getMessage());
            session()->flash('error', 'Payment initiation failed: ' . $e->getMessage());
        }
    }

    private function reduceStock($quantity)
    {
        $stockRecords = StockSeal::orderBy('created_at', 'asc')->get();

        foreach ($stockRecords as $stockRecord) {
            if ($quantity <= 0) break;

            $reduceAmount = min($stockRecord->stock, $quantity);
            $stockRecord->decrement('stock', $reduceAmount);
            $quantity -= $reduceAmount;
        }
    }

    private function restoreStock($quantity)
    {
        // Restore stock if payment fails
        $firstStock = StockSeal::orderBy('created_at', 'asc')->first();
        if ($firstStock) {
            $firstStock->increment('stock', $quantity);
        }
    }

    #[On('paymentSuccess')]
    public function handlePaymentSuccess()
    {
        if ($this->seal) {
            $this->seal->update(['status' => 'Success']);
            $this->reset(['pickup_point', 'quantity']);
            $this->quantity = 1;
            $this->totalPrice = $this->price;
            $this->calculateAvailableStock();
            session()->flash('success', 'Payment completed successfully!');
        }
    }

    #[On('paymentFailed')]
    public function handlePaymentFailure()
    {
        if ($this->seal) {
            $this->seal->update(['status' => 'Canceled']);
            $this->restoreStock($this->seal->quantity);
            session()->flash('error', 'Payment failed or canceled.');
        }
    }

    public function render()
    {
        return view('livewire.order-seal', [
            'availableStock' => $this->availableStock
        ]);
    }
}
