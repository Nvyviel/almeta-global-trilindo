<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipment;
use Illuminate\Support\Facades\Log;

class ShipmentData extends Component
{
    public $isOpen = false;
    public $editingShipmentId;

    public $from_city = '';
    public $to_city = '';
    public $vessel_name = '';
    public $closing_cargo = '';
    public $etb = '';
    public $etd = '';
    public $eta = '';
    public $rate = ''; // Added rate property

    public $cities = [
        'surabaya',
        'pontianak',
        'semarang',
        'banjarmasin',
        'sampit',
        'jakarta',
        'kumai',
        'samarinda',
        'balikpapan',
        'berau',
        'palu',
        'bitung',
        'gorontalo',
        'ambon'
    ];

    protected $rules = [
        'from_city' => 'required|string',
        'to_city' => 'required|string',
        'vessel_name' => 'required|string|max:255',
        'closing_cargo' => 'required|date',
        'etb' => 'required|date',
        'etd' => 'required|date|after:etb',
        'eta' => 'required|date|after:etd',
        'rate' => 'required|numeric|min:0', // Added rate validation
    ];

    protected $messages = [
        'from_city.required' => 'Port of Loading is required',
        'to_city.required' => 'Port of Discharge is required',
        'vessel_name.required' => 'Vessel name is required',
        'closing_cargo.required' => 'Closing cargo date is required',
        'etb.required' => 'ETB is required',
        'etd.required' => 'ETD is required',
        'eta.required' => 'ETA is required',
        'etd.after' => 'ETD must be after ETB',
        'eta.after' => 'ETA must be after ETD',
        'rate.required' => 'Rate per container is required',
        'rate.numeric' => 'Rate must be a number',
        'rate.min' => 'Rate cannot be negative',
    ];

    public function addSchedule()
    {
        try {
            $validatedData = $this->validate();

            // Convert vessel name to uppercase
            $validatedData['vessel_name'] = strtoupper($validatedData['vessel_name']);

            // Create the shipment
            Shipment::create($validatedData);

            // Reset form
            $this->reset(['from_city', 'to_city', 'vessel_name', 'closing_cargo', 'etb', 'etd', 'eta', 'rate']);

            // Show success message
            session()->flash('success', 'Shipment schedule created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to create shipment schedule. Please try again.');
        }
    }

    public function deleteShipment($shipmentId)
    {
        try {
            $shipment = Shipment::findOrFail($shipmentId);
            $shipment->delete();
            session()->flash('success', 'Shipment deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete shipment. Please try again.');
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset();
    }

    public function mount(Shipment $shipment)
    {
        $this->vessel_name = $shipment->vessel_name;
        $this->from_city = $shipment->from_city;
        $this->to_city = $shipment->to_city;
        $this->closing_cargo = $shipment->closing_cargo;
        $this->etb = $shipment->etb;
        $this->etd = $shipment->etd;
        $this->eta = $shipment->eta;
        $this->rate = $shipment->rate;
    }


    public function update()
    {
        $validatedData = $this->validate();

        $this->shipment->update($validatedData);

        session()->flash('success', 'Shipment updated successfully');
        return redirect()->route('dashboard-admin');
    }

    public function render()
    {
        $shipments = Shipment::all();
        return view('livewire.shipment-data', [
            'shipments' => $shipments
        ]);
    }
}