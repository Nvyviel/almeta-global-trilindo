<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        @php
            $fromCities = [
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
                'ambon',
            ];
        @endphp
        <h2 class="text-2xl font-bold mb-6">Tambah Data Consignee</h2>

        <form wire:submit="store" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Industry -->
                <div>
                    <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                    <input type="text" wire:model="industry" id="industry"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('industry')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name Consignee -->
                <div>
                    <label for="name_consignee" class="block text-sm font-medium text-gray-700">Nama Consignee</label>
                    <input type="text" wire:model="name_consignee" id="name_consignee"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name_consignee')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Kota</label>
                    <select wire:model="city"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                        <option value="" selected>Select City</option>
                        @foreach ($fromCities as $city)
                            <option value="{{ $city }}">{{ strtoupper($city) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="number" wire:model="phone_number" id="phone_number"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <!-- KTP -->
                <div>
                    <label for="ktp_consignee" class="block text-sm font-medium text-gray-700">Nomor KTP</label>
                    <input type="text" wire:model="ktp_consignee" id="ktp_consignee" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('ktp_consignee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- NPWP -->
                <div>
                    <label for="npwp_consignee" class="block text-sm font-medium text-gray-700">NPWP</label>
                    <input type="text" wire:model="npwp_consignee" id="npwp_consignee" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('npwp_consignee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div> --}}
            </div>

            <!-- Address - Full Width -->
            <div>
                <label for="consignee_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea wire:model="consignee_address" id="consignee_address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('consignee_address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="window.history.back()"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali
                </button>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                {{ session('message') }}
            </div>
        </div>
    @endif
</div>
