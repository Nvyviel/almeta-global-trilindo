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
    public $editingId = null;
    public $isModalOpen = false;
    public $editStock;

    public function mount()
    {
        $this->totalStock = StockSeal::sum('stock');
    }

    protected $rules = [
        'update_stock' => 'required|integer',
        'editStock' => 'required|integer'
    ];

    public function save()
    {
        $this->validate(['update_stock' => 'required|integer']);

        StockSeal::create([
            'user_id' => Auth::id(),
            'stock' => $this->update_stock,
            'update_stock' => $this->update_stock
        ]);

        $this->totalStock = StockSeal::sum('stock');
        $this->reset('update_stock');

        $this->dispatch('showAlert', [
            'type' => 'success',
            'title' => 'Success!',
            'text' => 'Stock has been added successfully'
        ]);

        return redirect()->route('create-seal')->with('success', 'Success updated Stock');
    }

    public function editModal($id)
    {
        $this->editingId = $id;
        $stockRecord = StockSeal::find($id);
        $this->editStock = $stockRecord->stock;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['editingId', 'editStock']);
    }

    public function updateStock()
    {
        $this->validate(['editStock' => 'required|integer']);

        $stockRecord = StockSeal::find($this->editingId);
        if ($stockRecord) {
            $stockRecord->update([
                'stock' => $this->editStock,
                'update_stock' => $this->editStock
            ]);

            $this->totalStock = StockSeal::sum('stock');
            $this->closeModal();

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => 'Updated!',
                'text' => 'Stock has been updated successfully'
            ]);
        }
    }

    public function confirmDelete($id)
    {
        $this->dispatch('showConfirmation', [
            'id' => $id,
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!"
        ]);
    }

    #[On('delete')]
    public function delete($id)
    {
        $stockRecord = StockSeal::find($id);
        if ($stockRecord) {
            $stockRecord->delete();
            $this->totalStock = StockSeal::sum('stock');

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => 'Deleted!',
                'text' => 'Stock record has been deleted successfully'
            ]);
        }
    }

    #[On('order-success')]
    public function render()
    {
        return view('livewire.stock-management', [
            'totalStock' => $this->totalStock,
            'stocks' => StockSeal::with('user')->latest()->get()
        ]);
    }
}
