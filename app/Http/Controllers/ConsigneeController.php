<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConsigneeController extends Controller
{
    public function index()
    {
        $consignees = Consignee::where('user_id', auth()->id())->paginate(10);
        return view('user.consignees.consignee', compact('consignees'));
    }

    public function edit(string $id)
    {
        $consignee = Consignee::findOrFail($id);

        return view('user.consignees.edit-consignee', compact('consignee'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'industry' => 'required|string|max:255',
            'name_consignee' => 'required|string|max:255',
            'email' => 'required|email|unique:consignees,email,' . $id,
            'city' => 'required|string|max:255|in:surabaya,pontianak,semarang,banjarmasin,sampit,jakarta,kumai,samarinda,balikpapan,berau,palu,bitung,gorontalo,ambon',
            'phone_number' => 'required|numeric',
            'consignee_address' => 'required|string',
            'ktp_consignee' => 'nullable|digits_between:1,20',
            'npwp_consignee' => 'nullable|digits_between:1,20'
        ]);

        $consignee = Consignee::findOrFail($id);

        $consignee->update($validated);

        return redirect()->route('consignee')
            ->with('success', 'Data consignee berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $consignee = Consignee::findOrFail($id);

        if ($consignee->ktp_consignee) {
            Storage::delete('public/' . $consignee->ktp_consignee);
        }
        if ($consignee->npwp_consignee) {
            Storage::delete('public/' . $consignee->npwp_consignee);
        }

        $consignee->delete();

        return redirect()->route('consignee')
            ->with('success', 'Data consignee berhasil dihapus');
    }

    public function createConsignee()
    {
        return view('user.consignees.create-consignee');
    }
}
