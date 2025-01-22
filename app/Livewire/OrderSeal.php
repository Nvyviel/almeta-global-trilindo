<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;

class OrderSeal extends Component
{
    public $pickup_point = 'surabaya';
    public $quantity = 1;
    public $price;
    public $newStock;
    public $selectedSealId;
    public $seals;

    protected $rules = [
        'pickup_point' => 'required|in:surabaya,pontianak,semarang,banjarmasin,bandung,jakarta',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric',
        'newStock' => 'nullable|integer|min:0'
    ];

    public function mount()
    {
        $this->loadSeals();
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
            'total_price' => $this->price * $this->quantity,
            'status' => 'requested',
            'stock' => 0
        ]);

        $this->reset(['pickup_point', 'quantity', 'price']);
        $this->loadSeals();
        session()->flash('success', 'Seal order created successfully!');
    }

    public function updateStock($sealId)
    {
        $this->validate([
            'newStock' => 'required|integer|min:0'
        ]);

        $seal = Seal::findOrFail($sealId);
        // Add the new stock to the current stock
        $seal->update([
            'stock' => $seal->stock + $this->newStock
        ]);

        $this->reset('newStock');
        $this->loadSeals();
        session()->flash('success', 'Stock updated successfully!');
    }

    public function render()
    {
        return view('livewire.order-seal');
    }
}
