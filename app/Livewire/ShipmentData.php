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
            $this->reset(['from_city', 'to_city', 'vessel_name', 'closing_cargo', 'etb', 'etd', 'eta']);

            // Show success message
            session()->flash('success', 'Shipment schedule created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to create shipment schedule. Please try again.');
        }
    }

    // Method untuk menghapus shipment
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
    }

    public function openEditModal($shipmentId)
    {
        $this->editingShipmentId = $shipmentId;
        $shipment = Shipment::findOrFail($shipmentId);

        $this->vessel_name = $shipment->vessel_name;
        $this->from_city = $shipment->from_city;
        $this->to_city = $shipment->to_city;
        $this->closing_cargo = $shipment->closing_cargo;
        $this->etb = $shipment->etb;
        $this->etd = $shipment->etd;
        $this->eta = $shipment->eta;

        $this->isOpen = true;
    }

    public function updateShipment()
    {
        $this->validate();

        try {
            $shipment = Shipment::findOrFail($this->editingShipmentId);

            $shipment->update([
                'vessel_name' => strtoupper($this->vessel_name),
                'from_city' => $this->from_city,
                'to_city' => $this->to_city,
                'closing_cargo' => $this->closing_cargo,
                'etb' => $this->etb,
                'etd' => $this->etd,
                'eta' => $this->eta,
            ]);

            $this->isOpen = false;
            $this->reset(['editingShipmentId']);
            session()->flash('success', 'Shipment updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to update shipment. Please try again.');
        }
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
