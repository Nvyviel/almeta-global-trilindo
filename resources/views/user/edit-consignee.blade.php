@extends('layouts.fullscreen')

@section('title','Edit Consignee')
@section('component')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Consignee</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('consignee-update', $consignee->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry', $consignee->industry) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700">Nama Consignee</label>
                        <input type="text" name="name_consignee"
                            value="{{ old('name_consignee', $consignee->name_consignee) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $consignee->email) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700">Kota</label>
                        <select name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon'] as $city)
                                <option value="{{ $city }}"
                                    {{ old('city', $consignee->city) == $city ? 'selected' : '' }}>
                                    {{ ucfirst($city) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">No. Telepon</label>
                        <input type="text" name="phone_number"
                            value="{{ old('phone_number', $consignee->phone_number) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700">Alamat</label>
                        <textarea name="consignee_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('consignee_address', $consignee->consignee_address) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('consignee') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
