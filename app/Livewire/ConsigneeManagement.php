<?php

namespace App\Livewire;

use App\Models\Consignee;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConsigneeManagement extends Component
{
    use WithFileUploads;

    public $industry;
    public $name_consignee;
    public $email;
    public $city;
    public $phone_number;
    public $consignee_address;
    public $ktp_consignee;
    public $npwp_consignee;

    protected $cities = [
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

    // Aturan validasi
    protected function rules()
    {
        return [
            'industry' => 'required|string',
            'name_consignee' => 'required|string',
            'email' => 'required|email|unique:consignees,email',
            'city' => 'required|string|in:' . implode(',', $this->cities),
            'phone_number' => 'required|numeric',
            'consignee_address' => 'required|string',
            // 'ktp_consignee' => 'required|string',
            // 'npwp_consignee' => 'required|string'
        ];
    }

    public function store()
    {
        $this->validate();

        Consignee::create([
            'user_id' => auth()->id(),
            'industry' => $this->industry,
            'name_consignee' => $this->name_consignee,
            'email' => $this->email,
            'city' => $this->city,
            'phone_number' => $this->phone_number,
            'consignee_address' => $this->consignee_address,
            // 'ktp_consignee' => $this->ktp_consignee,
            // 'npwp_consignee' => $this->npwp_consignee,
        ]);

        session()->flash('message', 'Data Consignee berhasil ditambahkan.');
        return redirect()->route('consignee');
    }

    public function render()
    {
        return view('livewire.consignee-management');
    }
}
