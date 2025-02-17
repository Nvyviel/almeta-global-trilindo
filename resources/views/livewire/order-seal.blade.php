<div class="container mx-auto px-4 py-6 md:py-12 max-w-3xl">
    <div class="space-y-4 mb-6">
        @if (session('success'))
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <div class="flex-grow">
                    <span class="mt-2 list-disc list-inside">
                        {{ session('success') }}
                    </span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 mt-2 sm:mt-0">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mb-2 sm:mb-0 sm:mr-4">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <p class="text-gray-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        <div
            class="bg-blue-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-0">
            <a href="{{ route('seal') }}" wire:navigate
                class="text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                <i class="fa-solid fa-arrow-left-long mr-2"></i>
                Back
            </a>
            <h2 class="text-xl sm:text-2xl font-bold text-blue-900 text-center flex-grow">Purchase Seal</h2>
            <div>
                @if (auth()->user()->is_admin == true)
                    <a href="{{ route('add-stock') }}" wire:navigate
                        class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-700 
                              hover:bg-blue-200 transition-colors whitespace-nowrap">
                        Add Stock
                    </a>
                @endif
            </div>
        </div>

        <form wire:submit.prevent="createSeal" class="p-4 sm:p-8 space-y-6 sm:space-y-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 sm:mb-3">Pickup Point</label>
                    <div class="relative">
                        <select wire:model="pickup_point"
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                            {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                            {{ $availableStock == 0 ? 'disabled' : '' }}>
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
                            <option value="" disabled selected>Select Pickup Point</option>
                            @foreach ($fromCities as $city)
                                <option value="{{ $city }}"
                                    {{ request('pickup_point') == $city ? 'selected' : '' }}>
                                    {{ strtoupper($city) }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </div>
                    @error('pickup_point')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                        Quantity
                        <span class="text-gray-500 ml-1">(Available: {{ $availableStock }})</span>
                    </label>
                    <input type="number" wire:model="quantity" id="quantity-input"
                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                        {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                        min="1" max="{{ $availableStock }}" {{ $availableStock == 0 ? 'disabled' : '' }}
                        onchange="updateTotalPrice(this.value)" oninput="updateTotalPrice(this.value)">
                    @error('quantity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($quantity > $availableStock)
                        <p class="mt-2 text-sm text-red-600">
                            Quantity cannot exceed available stock ({{ $availableStock }})
                        </p>
                    @endif
                </div>
            </div>

            {{-- Modified Price Details --}}
            <div class="bg-gray-50 rounded-xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium text-sm sm:text-base">Price per Unit:</span>
                    <span class="text-base sm:text-lg font-semibold text-blue-800" id="price-per-unit">Rp.
                        {{ number_format($price, 0, ',', '.') }}</span>
                </div>

                <div class="border-t border-gray-200 pt-3 sm:pt-4 flex justify-between items-center">
                    <span class="text-gray-600 font-medium text-sm sm:text-base">Total Price:</span>
                    <span class="text-xl sm:text-2xl font-bold text-blue-900" id="total-price">Rp.
                        {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Submit Button or Stock Unavailable Message --}}
            @if ($availableStock == 0)
                <div
                    class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 sm:px-6 py-4 sm:py-5 rounded-lg flex flex-col sm:flex-row items-center">
                    <div
                        class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mb-2 sm:mb-0 sm:mr-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-center sm:text-left">Stock is currently unavailable</span>
                </div>
            @else
                <button type="button" {{ $quantity > $availableStock ? 'disabled' : '' }} onclick="confirmPurchase()"
                    class="w-full px-6 sm:px-8 py-3 sm:py-3.5 
                    {{ $quantity > $availableStock ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }} 
                    text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 
                    flex items-center justify-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                    Purchase Seal
                </button>
            @endif
        </form>
    </div>
</div>

{{-- JavaScript --}}
<script>
    function confirmPurchase() {
        Swal.fire({
            title: 'Confirm Purchase',
            text: 'Are you sure you want to order these seals?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, order!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.createSeal();
            }
        });
    }

    Livewire.on('purchaseSuccess', () => {
        Swal.fire({
            title: 'Success!',
            text: 'Your seal purchase has been processed successfully.',
            icon: 'success',
            confirmButtonColor: '#2563eb'
        });
    });

    Livewire.on('purchaseError', (message) => {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    });
</script>
<script>
    // Get the base price from PHP
    const basePrice = {{ $price }};
    const availableStock = {{ $availableStock }};

    function formatPrice(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(price).replace('IDR', 'Rp.');
    }

    function updateTotalPrice(quantity) {
        // Validate quantity
        quantity = parseInt(quantity) || 0;
        if (quantity < 1) quantity = 1;
        if (quantity > availableStock) quantity = availableStock;

        // Calculate total price
        const totalPrice = quantity * basePrice;

        // Update the display
        document.getElementById('total-price').textContent = formatPrice(totalPrice);

        // Update Livewire component's quantity
        Livewire.dispatch('quantity-updated', {
            quantity: quantity
        });
    }

    // Initialize total price on page load
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        updateTotalPrice(quantityInput.value);
    });

    // Listen for direct input changes
    document.getElementById('quantity-input').addEventListener('input', function(e) {
        updateTotalPrice(e.target.value);
    });
</script>
