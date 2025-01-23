<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;

class OrderSeal extends Component
{
    public $pickup_point = 'surabaya';
    public $quantity = 1;
    public $price = 100000;
    public $totalPrice = 100000; // Initialize with default price
    public $newStock = [];
    public $seals;

    protected $rules = [
        'pickup_point' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
        'quantity' => 'required|integer|min:1',
        'newStock' => 'nullable|integer|min:0'
    ];

    public function mount()
    {
        $this->loadSeals();
        // Initialize newStock array for each seal
        foreach ($this->seals as $seal) {
            $this->newStock[$seal->id] = 0;
        }
    }

    // Remove debounce from quantity input and use wire:model directly
    public function updatedQuantity($value)
    {
        if ($value > 0) {
            $this->quantity = $value;
            $this->totalPrice = $this->quantity * $this->price;
        }
    }

    public function loadSeals()
    {
        $this->seals = Seal::all();
    }

    public function createSeal()
    {
        $this->validate();

        Seal::create([
            'user_id' => auth()->id(),
            'id_seal' => Seal::generateIdSeal(),
            'pickup_point' => $this->pickup_point,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total_price' => $this->totalPrice,
            'status' => 'requested',
            'stock' => 0
        ]);

        $this->reset(['pickup_point', 'quantity']);
        $this->quantity = 1; // Reset to 1 instead of 0
        $this->totalPrice = $this->price; // Reset total price to default price
        $this->loadSeals();
        
        session()->flash('success', 'Seal order created successfully!');
    }

    public function updateStock($sealId)
    {
        $this->validate([
            'newStock.' . $sealId => 'required|integer|min:0'  // Validate specific array index
        ]);

        $seal = Seal::findOrFail($sealId);
        $seal->update([
            'stock' => $this->newStock[$sealId]  // Use the array value
        ]);

        $this->newStock[$sealId] = 0;  // Reset only this specific input
        $this->loadSeals();
        session()->flash('success', 'Stock updated successfully!');
    }

    public function render()
    {
        return view('livewire.order-seal');
    }
}