<div class="container mx-auto px-4 py-8 max-w-2xl">
    {{-- Success Notification --}}
    @if(session()->has('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-md animate-fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Error Notification --}}
    @if(session()->has('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg shadow-md animate-fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Purchase Seal Form --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-5">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
                Purchase Seal
            </h2>
        </div>

        <form wire:submit.prevent="createSeal" class="p-6 space-y-6">
            <div class="grid gap-6 md:grid-cols-2">
                {{-- Pickup Point --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pickup Point</label>
                    <select wire:model="pickup_point" 
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 
                        {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                        {{ $availableStock == 0 ? 'disabled' : '' }}>
                        <option value="#" disabled>Select Pickup Point</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="pontianak">Pontianak</option>
                        <option value="semarang">Semarang</option>
                        <option value="banjarmasin">Banjarmasin</option>
                        <option value="bandung">Bandung</option>
                        <option value="jakarta">Jakarta</option>
                    </select>
                    @error('pickup_point') 
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Quantity 
                        <span class="text-gray-500 ml-1">(Available: {{ $availableStock }})</span>
                    </label>
                    <input type="number" 
                        wire:model="quantity" 
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500
                        {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                        min="1"
                        max="{{ $availableStock }}"
                        {{ $availableStock == 0 ? 'disabled' : '' }}>
                    @error('quantity') 
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if($quantity > $availableStock)
                        <p class="mt-2 text-sm text-red-600">
                            Quantity cannot exceed available stock ({{ $availableStock }})
                        </p>
                    @endif
                </div>
            </div>

            {{-- Price Details --}}
            <div class="bg-gray-50 rounded-lg p-6 space-y-4 border border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Price per Unit:</span>
                    <span class="text-lg font-semibold text-gray-800">Rp. {{ number_format($price, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Total Price:</span>
                    <span class="text-xl font-bold text-indigo-600">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Submit Button or Stock Unavailable Message --}}
            @if($availableStock == 0)
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">Stock is currently unavailable</span>
                </div>
            @else
                <button type="submit" 
                    {{ $quantity > $availableStock ? 'disabled' : '' }}
                    class="w-full px-8 py-3.5 
                    {{ $quantity > $availableStock ? 'bg-gray-400 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700' }} 
                    text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02] flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                    Purchase Seal
                </button>
            @endif

            <script>
                document.addEventListener('swal', (e) => {
                    Swal.fire({
                        icon: e.detail.type,
                        title: e.detail.title,
                        text: e.detail.text,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Lanjutkan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.finalSubmit();
                        }
                    });
                });
            </script>
        </form>
    </div>
</div>