<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StockSeal;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class StockManagement extends Component
{
    public $stock = 0;
    public $update_stock = 0;
    public $totalStock = 0;

    public function mount()
    {
        // Calculate total stock when component loads
        $this->totalStock = StockSeal::sum('stock');
    }

    protected $rules = [
        'update_stock' => 'required|integer'
    ];

    public function save()
    {
        // Validate input
        $this->validate();

        // Create new stock entry
        StockSeal::create([
            'user_id' => Auth::id(),
            'stock' => $this->update_stock, // Use update_stock as new stock amount
            'update_stock' => $this->update_stock
        ]);

        // Recalculate total stock
        $this->totalStock = StockSeal::sum('stock');

        // Reset form after success
        $this->reset('update_stock');

        $this->dispatch('success');

        // Send flash message
        session()->flash('success', 'Stock seal berhasil ditambahkan');
    }

    #[On('order-success')]
    public function render()
    {
        return view('livewire.stock-management', [
            'totalStock' => $this->totalStock
        ]);
    }
}
