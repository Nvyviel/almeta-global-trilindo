<div class="container mx-auto px-4 py-6">
    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->is_admin)
        {{-- Admin View --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Seal Stock Management</h2>
            </div>
            <div class="p-6">
                @foreach($seals as $seal)
                    <div class="mb-6 p-4 border border-gray-200 rounded-lg hover:shadow-sm transition-shadow">
                        <h5 class="text-lg font-medium text-gray-700 mb-3">Seal ID: {{ $seal->id_seal }}</h5>
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-600">
                                Current Stock: <span class="text-gray-800">{{ $seal->stock }}</span>
                            </label>
                            <input type="number" 
                                wire:model.defer="newStock" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                                min="0">
                            <button wire:click="updateStock({{ $seal->id }})" 
                                class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Update Stock
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        {{-- User View --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Purchase Seal</h2>
            </div>
            <div class="p-6">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Point</label>
                        <select wire:model="pickup_point" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            {{ $seals->sum('stock') == 0 ? 'disabled' : '' }}>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <input type="number" 
                            wire:model="quantity" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            min="1"
                            {{ $seals->sum('stock') == 0 ? 'disabled' : '' }}>
                        @error('quantity') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" 
                            wire:model="price" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            {{ $seals->sum('stock') == 0 ? 'disabled' : '' }}>
                        @error('price') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($seals->sum('stock') == 0)
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md">
                            Stock is unavailable
                        </div>
                    @else
                        <button type="submit" 
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Purchase Seal
                        </button>
                    @endif
                </form>
            </div>
        </div>
    @endif
</div>