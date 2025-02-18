<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;
use App\Models\StockSeal;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;


class OrderSeal extends Component
{
    public $pickup_point = 'surabaya';
    public $quantity = 1;
    public $price = 100000;
    public $totalPrice = [];
    public $availableStock = 0;
    public $seal;

    protected $rules = [
        'pickup_point' => 'required|in:surabaya,pontianak,semarang,banjarmasin,sampit,jakarta,kumai,samarinda,balikpapan,berau,palu,bitung,gorontalo,ambon',
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

        DB::beginTransaction();

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
            
            $this->dispatch('order-success');
            session()->flash('success', 'Order created successfully!');
            
            $this->reset(['pickup_point', 'quantity']);
            $this->quantity = 1;
            $this->totalPrice = $this->price;
            $this->calculateAvailableStock();
            
            DB::commit();

            return redirect()->route('seal');
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('purchaseError', $e->getMessage());
            session()->flash('error', 'Failed to create order: ' . $e->getMessage());

            return redirect()->route('seal');
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
        $firstStock = StockSeal::orderBy('created_at', 'asc')->first();
        if ($firstStock) {
            $firstStock->increment('stock', $quantity);
        }
    }

    public function render()
    {
        return view('livewire.order-seal', [
            'availableStock' => $this->availableStock
        ]);
    }
}