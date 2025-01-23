<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;
use App\Models\StockSeal;
use Livewire\Attributes\On;

class OrderSeal extends Component
{
    public $pickup_point = 'surabaya';
    public $quantity = 1;
    public $price = 100000;
    public $totalPrice = 100000;
    public $availableStock = 0;

    protected $rules = [
        'pickup_point' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
        'quantity' => 'required|integer|min:1'
    ];

    public function mount()
    {
        $this->calculateAvailableStock();
    }

    #[On('success')]
    public function calculateAvailableStock()
    {
        // Sum the total available stock from stock_seals table
        $this->availableStock = StockSeal::sum('stock');
    }

    public function updatedQuantity($value)
    {
        if ($value > 0) {
            $this->quantity = $value;
            $this->totalPrice = $this->quantity * $this->price;
        }
    }

    public function createSeal()
    {
        $this->validate();

        // Check if requested quantity exceeds available stock
        if ($this->quantity > $this->availableStock) {
            session()->flash('error', 'Requested quantity exceeds available stock!');
            return;
        }

        // Create seal order
        $seal = Seal::create([
            'user_id' => auth()->id(),
            'id_seal' => Seal::generateIdSeal(),
            'pickup_point' => $this->pickup_point,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total_price' => $this->totalPrice,
            'status' => 'Payment Proccess'
        ]);

        // Reduce available stock
        $this->reduceStock($this->quantity);
        $this->dispatch('order-success');
        $this->reset(['pickup_point', 'quantity']);
        $this->quantity = 1;
        $this->totalPrice = $this->price;
        $this->calculateAvailableStock();

        session()->flash('success', 'Seal order created successfully!');
    }

    private function reduceStock($quantity)
    {
        // Reduce stock from stock_seals table
        $stockRecords = StockSeal::orderBy('created_at', 'asc')->get();

        foreach ($stockRecords as $stockRecord) {
            if ($quantity <= 0) break;

            $reduceAmount = min($stockRecord->stock, $quantity);
            $stockRecord->decrement('stock', $reduceAmount);
            $quantity -= $reduceAmount;
        }
    }

    public function render()
    {
        return view('livewire.order-seal', [
            'availableStock' => $this->availableStock
        ]);
    }
}
