<div class="min-h-screen py-4 sm:py-8">
    <!-- Notifications - Made more responsive -->
    @if (session()->has('success'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div
                class="bg-green-100 border border-green-200 text-green-700 px-3 py-2 sm:px-4 sm:py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <p class="text-sm sm:text-base">{{ session('success') }}</p>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-700 hover:text-green-900 ml-2">
                        <span class="text-xl sm:text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div class="bg-red-100 border border-red-200 text-red-700 px-3 py-2 sm:px-4 sm:py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <p class="text-sm sm:text-base">{{ session('error') }}</p>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-700 hover:text-red-900 ml-2">
                        <span class="text-xl sm:text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Create Shipment Form Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#2563EB] p-4 sm:p-6">
                <h1 class="text-xl sm:text-2xl font-semibold text-white text-center">Create Shipment Schedule</h1>
            </div>

            <div class="p-4 sm:p-6">
                <form wire:submit.prevent="addSchedule" class="space-y-4 sm:space-y-6">
                    <!-- Form Groups -->
                    <div class="space-y-4 sm:space-y-6">
                        <!-- Vessel Name -->
                        <div class="w-full">
                            <label for="vessel_name"
                                class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Vessel Name</label>
                            <input type="text" wire:model.defer="vessel_name" id="vessel_name"
                                class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]"
                                placeholder="Enter vessel name" style="text-transform: uppercase;">
                        </div>

                        <!-- Rates Section - Responsive grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Rate -->
                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Rate
                                    (IDR)</label>
                                <input type="text" wire:model.defer="rate"
                                    class="format-number w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]"
                                    placeholder="Enter rate">
                            </div>

                            <!-- Rate Per Container -->
                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Rate Per
                                    Container (IDR)</label>
                                <input type="text" wire:model.defer="rate_per_container"
                                    class="format-number w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]"
                                    placeholder="Enter rate per container">
                            </div>
                        </div>

                        <!-- Dates Section - Responsive grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                            <!-- Date inputs with consistent styling -->
                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Closing
                                    Cargo</label>
                                <input type="datetime-local" wire:model.defer="closing_cargo"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">ETB</label>
                                <input type="datetime-local" wire:model.defer="etb"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">ETD</label>
                                <input type="datetime-local" wire:model.defer="etd"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">ETA</label>
                                <input type="datetime-local" wire:model.defer="eta"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                            </div>
                        </div>

                        <!-- Ports Section - Responsive grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- POL -->
                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Port of Loading
                                    (POL)</label>
                                <select wire:model.defer="from_city"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                                    <option value="">Select Port of Loading</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- POD -->
                            <div>
                                <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Port of
                                    Discharge (POD)</label>
                                <select wire:model.defer="to_city"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                                    <option value="">Select Port of Discharge</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-6 sm:mt-8">
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 bg-[#2563EB] text-white text-sm sm:text-base font-medium rounded-lg shadow-sm hover:bg-[#1d4ed8] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2 transition-all duration-200">
                                <span wire:loading.remove>Create Shipment</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shipments List Section -->
        <div class="mt-6 sm:mt-8">
            <div class="bg-[#2563EB] p-4 sm:p-6 rounded-lg mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-white text-center">Shipments List</h2>
            </div>

            @if ($shipments->count() > 0)
                <div class="space-y-4 sm:space-y-6">
                    @foreach ($shipments as $shipment)
                        <div
                            class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                            <div class="p-4 sm:p-6">
                                <!-- Header with Closing Date -->
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4">
                                    <div>
                                        <div class="flex flex-col sm:flex-row sm:items-center text-gray-600 mt-2">
                                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-1">
                                                {{ $shipment->vessel_name }}
                                            </h3>
                                            <div class="flex items-center mt-2 sm:mt-0">
                                                <span
                                                    class="font-medium text-sm sm:ml-3">{{ strtoupper($shipment->from_city) }}</span>
                                                <i class="fa-solid fa-arrow-right-long text-xs text-gray-500 p-2"></i>
                                                <span
                                                    class="font-medium text-sm">{{ strtoupper($shipment->to_city) }}</span>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            Closing:
                                            {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y - H:i') }}
                                        </p>
                                    </div>
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium mt-2 sm:mt-0">Available</span>
                                </div>

                                <!-- Timeline Grid -->
                                <div
                                    class="border-2 bg-blue-50 border-dashed border-blue-400 rounded-lg p-3 sm:p-4 mb-4">
                                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-4 items-center">
                                        <!-- Ship Icon -->
                                        <div class="col-span-2 sm:col-span-1 flex justify-center">
                                            <i class="fa-solid fa-ship text-blue-600 text-3xl sm:text-4xl"></i>
                                        </div>

                                        <!-- Timeline Items -->
                                        <div class="space-y-1 text-center">
                                            <p class="text-xs sm:text-sm font-medium text-gray-500">ETB</p>
                                            <p class="text-sm sm:text-base font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($shipment->etb)->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="space-y-1 text-center">
                                            <p class="text-xs sm:text-sm font-medium text-gray-500">ETD</p>
                                            <p class="text-sm sm:text-base font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($shipment->etd)->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="space-y-1 text-center">
                                            <p class="text-xs sm:text-sm font-medium text-gray-500">ETA</p>
                                            <p class="text-sm sm:text-base font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($shipment->eta)->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1 flex justify-center mt-3 sm:mt-0">
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fa-solid fa-anchor text-blue-600 text-lg sm:text-xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Action Buttons -->
                                <div
                                    class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-4 sm:gap-0">
                                    <div class="text-center sm:text-left">
                                        <p class="text-2xl sm:text-3xl font-bold text-gray-900">
                                            Rp {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs sm:text-sm text-gray-500">/ Container</p>
                                    </div>
                                    <div class="hidden sm:block w-px h-12 bg-gray-200 mx-6"></div>
                                    <div class="flex gap-3 w-full sm:w-auto">
                                        <a href="{{ route('edit-shipment', $shipment->id) }}" wire:navigate
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2 bg-blue-600 text-white font-medium text-sm rounded-full hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button wire:click="deleteShipment({{ $shipment->id }})"
                                            wire:confirm="Are you sure you want to delete this shipment?"
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2 bg-red-500 text-white font-medium text-sm rounded-full hover:bg-red-600 focus:ring-4 focus:ring-red-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State - Made responsive -->
                <div class="bg-white rounded-lg shadow-md p-6 sm:p-8 text-center">
                    <svg class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-gray-400 mb-3 sm:mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-base sm:text-lg font-medium text-gray-500">No shipments available!</p>
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

        // Auto-hide notifications after 5 seconds with responsive timing
        const notifications = document.querySelectorAll('[class*="fixed top-4"]');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        });

        // Number formatting for inputs
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
