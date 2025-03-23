<div class="min-h-screen py-6 sm:py-12">
    <!-- Notifications - Simplified without animation -->
    @if (session()->has('success'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div
                class="bg-green-50 border-l-4 border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-md flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm sm:text-base font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-auto text-green-700 hover:text-green-900">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div
                class="bg-red-50 border-l-4 border-red-400 text-red-800 px-4 py-3 rounded-lg shadow-md flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm sm:text-base font-medium">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-auto text-red-700 hover:text-red-900">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Create Shipment Form Section - Clean and modern design -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="bg-blue-600 p-5">
                <h1 class="text-2xl font-bold text-white text-center">Create Shipment Schedule</h1>
            </div>

            <div class="p-6">
                <form wire:submit.prevent="addSchedule" class="space-y-6">
                    <!-- Form Groups -->
                    <div class="space-y-6">
                        <!-- Vessel Name with icon -->
                        <div class="w-full">
                            <label for="vessel_name" class="flex items-center text-gray-700 font-medium mb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                </svg>
                                Vessel Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-ship text-gray-400"></i>
                                </div>
                                <input type="text" wire:model.defer="vessel_name" id="vessel_name"
                                    class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Enter vessel name" style="text-transform: uppercase;">
                            </div>
                        </div>

                        <!-- Rates with better spacing and separation -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="flex items-center text-gray-700 font-medium mb-2">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Rate (IDR)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="rate"
                                        class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter rate" oninput="formatNumber(this)"
                                        onblur="formatNumber(this)">
                                </div>
                            </div>

                            <div>
                                <label class="flex items-center text-gray-700 font-medium mb-2">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Rate Per Container (IDR)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="rate_per_container"
                                        class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter rate per container" oninput="formatNumber(this)"
                                        onblur="formatNumber(this)">
                                </div>
                            </div>
                        </div>

                        <!-- Dates Section - Clean and functional -->
                        <div>
                            <h4 class="text-gray-700 font-medium mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Schedule Information
                                <span class="h-px flex-1 bg-gray-200 ml-3"></span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <!-- Date inputs with clean styling -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Closing Cargo</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="datetime-local" wire:model.defer="closing_cargo"
                                            class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">ETB</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="datetime-local" wire:model.defer="etb"
                                            class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">ETD</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="datetime-local" wire:model.defer="etd"
                                            class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">ETA</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="datetime-local" wire:model.defer="eta"
                                            class="w-full pl-10 pr-4 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ports Section - Clean and functional -->
                        <div>
                            <h4 class="text-gray-700 font-medium mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Port Information
                                <span class="h-px flex-1 bg-gray-200 ml-3"></span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <!-- POL with clean select styling -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Port of Loading (POL)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                        <select wire:model.defer="from_city"
                                            class="w-full pl-10 pr-10 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                            <option value="">Select Port of Loading</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- POD with clean select styling -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Port of Discharge (POD)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                        <select wire:model.defer="to_city"
                                            class="w-full pl-10 pr-10 py-3 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                            <option value="">Select Port of Discharge</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button - Clean, modern design -->
                        <div class="flex justify-center mt-8">
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white text-base font-medium rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span wire:loading.remove class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Create Shipment
                                </span>
                                <span wire:loading class="flex items-center justify-center">
                                    <svg class="h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shipments List Section -->
        <div class="mt-8">
            <!-- Header - Clean, modern design -->
            <div class="bg-blue-600 p-5 rounded-lg mb-6 shadow-sm">
                <h2 class="text-xl sm:text-2xl font-bold text-white text-center flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                    Shipments List
                </h2>
            </div>

            @if ($shipments->count() > 0)
                <div class="space-y-6">
                    @foreach ($shipments as $shipment)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-5 sm:p-6">
                                <!-- Header with Closing Date - Clean layout -->
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-5">
                                    <div class="flex-1">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                                            <h3 class="text-lg sm:text-2xl font-bold text-gray-900">
                                                {{ $shipment->vessel_name }}
                                            </h3>
                                            <div
                                                class="flex items-center mt-1 sm:mt-0 bg-gray-100 rounded-full px-3 py-1">
                                                <span
                                                    class="font-semibold text-sm text-gray-700">{{ strtoupper($shipment->from_city) }}</span>
                                                <div class="mx-2 flex items-center">
                                                    <span class="h-0.5 w-2 bg-blue-500 rounded-full"></span>
                                                    <span class="h-0.5 w-2 bg-blue-500 rounded-full mx-0.5"></span>
                                                    <span class="h-0.5 w-2 bg-blue-500 rounded-full"></span>
                                                </div>
                                                <span
                                                    class="font-semibold text-sm text-gray-700">{{ strtoupper($shipment->to_city) }}</span>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Closing:
                                            {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y - H:i') }}
                                        </p>
                                    </div>
                                    <span
                                        class="px-4 py-1.5 bg-green-100 text-green-800 text-sm font-medium rounded-full mt-3 sm:mt-0 inline-flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                                        Available
                                    </span>
                                </div>

                                <!-- Timeline Grid - Clean, functional design -->
                                <div class="bg-gray-50 rounded-lg p-4 sm:p-5 mb-5 border border-gray-200">
                                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 sm:gap-6 items-center">
                                        <!-- Ship Icon -->
                                        <div class="col-span-1 flex justify-center">
                                            <div
                                                class="w-16 h-16 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center">
                                                <i class="fa-solid fa-ship text-blue-600 text-2xl"></i>
                                            </div>
                                        </div>

                                        <!-- Timeline Items -->
                                        <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                            <div class="text-center space-y-1">
                                                <p
                                                    class="text-xs font-semibold text-blue-500 uppercase tracking-wider">
                                                    ETB</p>
                                                <p class="text-base sm:text-lg font-bold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y') }}
                                                </p>
                                                <p
                                                    class="text-xs text-gray-500 bg-gray-100 rounded-full py-0.5 px-2 inline-block">
                                                    {{ \Carbon\Carbon::parse($shipment->etb)->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                            <div class="text-center space-y-1">
                                                <p
                                                    class="text-xs font-semibold text-blue-500 uppercase tracking-wider">
                                                    ETD</p>
                                                <p class="text-base sm:text-lg font-bold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y') }}
                                                </p>
                                                <p
                                                    class="text-xs text-gray-500 bg-gray-100 rounded-full py-0.5 px-2 inline-block">
                                                    {{ \Carbon\Carbon::parse($shipment->etd)->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                            <div class="text-center space-y-1">
                                                <p
                                                    class="text-xs font-semibold text-blue-500 uppercase tracking-wider">
                                                    ETA</p>
                                                <p class="text-base sm:text-lg font-bold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y') }}
                                                </p>
                                                <p
                                                    class="text-xs text-gray-500 bg-gray-100 rounded-full py-0.5 px-2 inline-block">
                                                    {{ \Carbon\Carbon::parse($shipment->eta)->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-span-1 flex justify-center">
                                            <div
                                                class="w-16 h-16 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center">
                                                <i class="fa-solid fa-anchor text-indigo-600 text-2xl"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress bar indication - Simplified design -->
                                    <div class="mt-4 pt-2 px-2 hidden sm:block">
                                        <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-500 rounded-full w-1/2"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500 mt-1 px-1">
                                            <span>Departed</span>
                                            <span>In Transit</span>
                                            <span>Arrived</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Action Buttons - Clean, functional design -->
                                <div
                                    class="flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-0 pt-2 border-t border-gray-100">
                                    <div class="text-center sm:text-left">
                                        <p class="text-sm text-gray-500 mb-1">Container Price</p>
                                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                                            Rp {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-gray-500">per container unit</p>
                                    </div>

                                    <div class="flex gap-3 w-full sm:w-auto">
                                        <a href="{{ route('edit-shipment', $shipment->id) }}" wire:navigate
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 shadow-sm">
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
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2.5 bg-white text-red-600 border border-red-200 font-medium text-sm rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-100 shadow-sm">
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
                <!-- Empty State - Clean, modern design -->
                <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-gray-200">
                    <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <p class="text-xl font-semibold text-gray-700 mb-2">No shipments available!</p>
                    <p class="text-gray-500 max-w-md mx-auto">There are no active shipments at the moment. Create a new
                        shipment to get started.</p>
                    <button
                        class="mt-6 px-6 py-2.5 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Create New Shipment
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.formatNumber = function(input) {
            let cursorPos = input.selectionStart;

            let value = input.value.replace(/\D/g, '');

            let originalLength = input.value.length;

            let formattedValue = '';
            while (value.length > 3) {
                formattedValue = '.' + value.substr(value.length - 3) + formattedValue;
                value = value.substr(0, value.length - 3);
            }
            formattedValue = value + formattedValue;

            let newLength = formattedValue.length;
            let lengthDiff = newLength - originalLength;
            let newCursorPos = cursorPos + lengthDiff;

            input.value = formattedValue;

            if (cursorPos <= originalLength) {
                input.setSelectionRange(newCursorPos, newCursorPos);
            }
        };

        document.querySelectorAll('.format-number').forEach(input => {
            input.addEventListener('input', function() {
                formatNumber(this);
            });

            input.addEventListener('blur', function() {
                formatNumber(this);
            });

            if (input.value) {
                formatNumber(input);
            }
        });

        // Simple notification removal after time
        const notifications = document.querySelectorAll('[class*="fixed top-4"]');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.remove();
            }, 5000);
        });
    });
</script>
