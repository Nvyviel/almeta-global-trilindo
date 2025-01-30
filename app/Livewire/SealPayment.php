<?php

namespace App\Livewire;

use Midtrans\Snap;
use App\Models\Seal;
use Midtrans\Config;
use Livewire\Component;
use Livewire\Attributes\On;

class SealPayment extends Component
{
    public $seal;
    public $snapToken;

    private function setupMidtransConfig()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function initializePayment($sealId)
    {
        try {
            $this->seal = Seal::findOrFail($sealId);
            $this->setupMidtransConfig();

            $transactionDetails = [
                'order_id' => 'SEAL-' . $this->seal->id . '-' . time(),
                'gross_amount' => (int) $this->seal->total_price
            ];

            $customerDetails = [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ];

            $itemDetails = [
                [
                    'id' => $this->seal->id_seal,
                    'price' => $this->seal->price,
                    'quantity' => $this->seal->quantity,
                    'name' => 'Seal from ' . $this->seal->pickup_point,
                ]
            ];

            $midtransParams = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails,
            ];

            $this->snapToken = Snap::getSnapToken($midtransParams);
            $this->dispatch('showPaymentModal', $this->snapToken);
        } catch (\Exception $e) {
            $this->dispatch('purchaseError', $e->getMessage());
        }
    }

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
