<div class="container mx-auto px-4 py-8">
    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 animate-fade-in">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Admin View --}}
    @if(auth()->user()->is_admin)
        <div class="bg-white rounded-xl shadow-lg mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-xl">
                <h2 class="text-xl font-bold text-white">Seal Stock Management</h2>
            </div>
            <div class="p-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($seals as $seal)
                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 hover:shadow-md transition-all duration-300">
                        <h5 class="text-lg font-semibold text-gray-800 mb-4">Seal ID: {{ $seal->id_seal }}</h5>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 font-medium">Current Stock:</span>
                                <span class="text-blue-600 font-bold">{{ $seal->stock }}</span>
                            </div>
                            <div class="relative">
                                <input type="number" 
                                    wire:model="newStock" 
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                    min="0"
                                    placeholder="Enter new stock">
                            </div>
                            <button wire:click="updateStock({{ $seal->id }})" 
                                class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 transform hover:scale-[1.02]">
                                Update Stock
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- User View --}}
    <div class="bg-white rounded-xl shadow-lg">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-xl">
            <h2 class="text-xl font-bold text-white">Purchase Seal</h2>
        </div>
        <div class="p-6">
            <form wire:submit.prevent="createSeal" class="space-y-6">
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pickup Point</label>
                        <select wire:model="pickup_point" 
                            class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            {{ $seals->sum('stock') == 0 ? 'disabled' : '' }}>
                            <option value="#" selected disabled>Select Pickup Point</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="pontianak">Pontianak</option>
                            <option value="semarang">Semarang</option>
                            <option value="banjarmasin">Banjarmasin</option>
                            <option value="bandung">Bandung</option>
                            <option value="jakarta">Jakarta</option>
                        </select>
                        @error('pickup_point') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
                        <input type="number" 
                            wire:model="quantity" 
                            class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            min="1"
                            {{ $seals->sum('stock') == 0 ? 'disabled' : '' }}>
                        @error('quantity') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Price per Unit:</span>
                        <span class="text-lg font-semibold text-gray-800">Rp. {{ number_format($price, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Total Price:</span>
                        <span class="text-xl font-bold text-blue-600">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($seals->sum('stock') == 0)
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">Stock is currently unavailable</span>
                        </div>
                    </div>
                @else
                    <button type="submit" 
                        class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02]">
                        Purchase Seal
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>