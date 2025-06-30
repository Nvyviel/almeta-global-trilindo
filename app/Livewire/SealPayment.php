<?php

namespace App\Livewire;

use App\Models\Seal;
use Livewire\Component;
use Livewire\Attributes\On;

class SealPayment extends Component
{
    public $seal;
    public $snapToken;

    #[On('paymentSuccess')]
    public function handlePaymentSuccess()
    {
        if ($this->seal) {
            $this->seal->update(['status' => 'Success']);
            session()->flash('success', 'Payment completed successfully!');
            return redirect()->route('seal');
        }
    }

    #[On('paymentFailed')]
    public function handlePaymentFailure()
    {
        if ($this->seal) {
            $this->seal->update(['status' => 'Canceled']);
            session()->flash('error', 'Payment failed or canceled.');
            return redirect()->route('seal');
        }
    }

    public function render()
    {
        return view('livewire.seal-payment');
    }
}
