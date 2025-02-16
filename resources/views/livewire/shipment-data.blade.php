<div class="min-h-screen py-8">
    {{-- Fixed Notifications --}}
    @if (session()->has('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md mx-4">
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-700 hover:text-green-900">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md mx-4">
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <p>{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Create Shipment Form Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#2563EB] p-6">
                <h1 class="text-2xl font-semibold text-white text-center">Create Shipment Schedule</h1>
            </div>

            <div class="p-6">
                <form wire:submit.prevent="addSchedule" class="space-y-6">
                    <div class="space-y-6">
                        <!-- Vessel Name -->
                        <div class="w-full">
                            <label for="vessel_name" class="block text-gray-600 font-medium mb-2">Vessel Name</label>
                            <input type="text" wire:model.defer="vessel_name" id="vessel_name"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('vessel_name') border-red-300 @enderror"
                                placeholder="Enter vessel name" style="text-transform: uppercase;" autofocus>
                            @error('vessel_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Rates Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Rate -->
                            <div>
                                <label for="rate" class="block text-gray-600 font-medium mb-2">Rate (IDR)</label>
                                <input type="text" id="rate" wire:model.defer="rate"
                                    class="format-number w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('rate') border-red-300 @enderror"
                                    placeholder="Enter rate">
                                @error('rate')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Rate Per Container -->
                            <div>
                                <label for="rate_per_container" class="block text-gray-600 font-medium mb-2">Rate Per
                                    Container (IDR)</label>
                                <input type="text" id="rate_per_container" wire:model.defer="rate_per_container"
                                    class="format-number w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('rate_per_container') border-red-300 @enderror"
                                    placeholder="Enter rate per container">
                                @error('rate_per_container')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dates Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Closing Cargo -->
                            <div>
                                <label for="closing_cargo" class="block text-gray-600 font-medium mb-2">Closing
                                    Cargo</label>
                                <input type="datetime-local" wire:model.defer="closing_cargo" id="closing_cargo"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('closing_cargo') border-red-300 @enderror">
                                @error('closing_cargo')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ETB -->
                            <div>
                                <label for="etb" class="block text-gray-600 font-medium mb-2">ETB</label>
                                <input type="datetime-local" wire:model.defer="etb" id="etb"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('etb') border-red-300 @enderror">
                                @error('etb')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ETD -->
                            <div>
                                <label for="etd" class="block text-gray-600 font-medium mb-2">ETD</label>
                                <input type="datetime-local" wire:model.defer="etd" id="etd"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('etd') border-red-300 @enderror">
                                @error('etd')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ETA -->
                            <div>
                                <label for="eta" class="block text-gray-600 font-medium mb-2">ETA</label>
                                <input type="datetime-local" wire:model.defer="eta" id="eta"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('eta') border-red-300 @enderror">
                                @error('eta')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Ports Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- POL -->
                            <div>
                                <label for="from_city" class="block text-gray-600 font-medium mb-2">Port of Loading
                                    (POL)</label>
                                <select wire:model.defer="from_city" id="from_city"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('from_city') border-red-300 @enderror">
                                    <option value="">Select Port of Loading</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                                @error('from_city')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- POD -->
                            <div>
                                <label for="to_city" class="block text-gray-600 font-medium mb-2">Port of Discharge
                                    (POD)</label>
                                <select wire:model.defer="to_city" id="to_city"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB] @error('to_city') border-red-300 @enderror">
                                    <option value="">Select Port of Discharge</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                                @error('to_city')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-8">
                            <button type="submit"
                                class="px-6 py-3 bg-[#2563EB] text-white font-medium rounded-lg shadow-sm hover:bg-[#1d4ed8] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2 transition-all duration-200"
                                wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed">
                                <span wire:loading.remove>Create Shipment</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shipments List Section -->
        <div class="mt-8">
            <div class="bg-[#2563EB] p-6 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-white text-center">Shipments List</h2>
            </div>

            @if ($shipments->count() > 0)
                <div class="space-y-6">
                    @foreach ($shipments as $shipment)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="bg-gray-50 p-4 border-b border-gray-200">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <h3 class="text-lg font-semibold text-gray-700">{{ $shipment->vessel_name }}</h3>
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        <div class="flex items-center space-x-2 text-gray-600">
                                            <span>{{ strtoupper($shipment->from_city) }}</span>
                                            <span class="text-[#2563EB]">&rarr;</span>
                                            <span>{{ strtoupper($shipment->to_city) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Rate</p>
                                        <p class="text-gray-700">Rp. {{ number_format($shipment->rate, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Rate per Container</p>
                                        <p class="text-gray-700">Rp.
                                            {{ number_format($shipment->rate_per_container, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Closing Cargo</p>
                                        <p class="text-gray-700">
                                            {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">ETB</p>
                                        <p class="text-gray-700">
                                            {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">ETD</p>
                                        <p class="text-gray-700">
                                            {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">ETA</p>
                                        <p class="text-gray-700">
                                            {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('edit-shipment', $shipment->id) }}" wire:navigate
                                        class="inline-flex justify-center items-center px-4 py-2 bg-[#2563EB] text-white font-medium rounded-lg hover:bg-[#1d4ed8] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <button wire:click="deleteShipment({{ $shipment->id }})"
                                        wire:confirm="Are you sure you want to delete this shipment?"
                                        class="inline-flex justify-center items-center px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-lg font-medium text-gray-500">No shipments available!</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function formatNumber(input) {
            let rawValue = input.value.replace(/\D/g, '');
            if (rawValue.length > 9) rawValue = rawValue.substring(0, 9);

            let oldLength = input.value.length;
            let oldCursorPosition = input.selectionStart;

            let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            let newLength = formattedValue.length;
            let lengthDiff = newLength - oldLength;

            input.value = formattedValue;

            let newCursorPosition = oldCursorPosition + lengthDiff;
            input.setSelectionRange(newCursorPosition, newCursorPosition);
        }

        // Auto-hide notifications after 5 seconds
        const notifications = document.querySelectorAll('[class*="fixed top-4"]');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        });

        document.querySelectorAll('.format-number').forEach(input => {
            input.addEventListener('input', function() {
                formatNumber(this);
            });

            input.addEventListener('blur', function() {
                formatNumber(this);
            });
        });
    });
</script>
