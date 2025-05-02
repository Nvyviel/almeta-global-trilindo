@extends('layouts.main')

@section('title', 'Dashboard')
@section('component')
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

    <!-- Success Alert with animation -->
    @if (session('success'))
        <div id="success-alert"
            class="fixed top-4 right-4 z-50 flex items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('success-alert').classList.add('translate-x-full', 'opacity-0')"
                class="text-green-600 hover:text-green-800 focus:outline-none ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Search Form Section - EXACT COPY FROM FIRST CODE -->
    <div class="py-8 sm:py-12 lg:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-10 lg:mb-14">
                <span
                    class="inline-block px-3 py-1.5 bg-blue-100 text-blue-800 text-xs sm:text-sm font-medium rounded-full mb-3 animate-pulse">Search
                    Routes</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 sm:mb-3">
                    Find Your Perfect Shipping Route
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Select ports and discover available
                    shipments with competitive rates</p>
            </div>

            <!-- Search Form with floating effect -->
            <form action="{{ route('dashboard') }}" method="GET"
                class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 border border-gray-100 transform hover:translate-y-[-5px] transition-all duration-300"
                onsubmit="handleFormSubmit(event)">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-5 items-end">
                    <!-- POL Selection -->
                    <div class="lg:col-span-5">
                        <label for="pol" class="block mb-2 text-sm font-bold text-gray-700">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-blue-600 mr-2"></i>
                                Port of Loading (POL)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pol" id="pol"
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 border-gray-200 hover:border-blue-400 rounded-lg sm:rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled selected>Select Port of Loading</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pol') == $city ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 pointer-events-none text-gray-400 group-hover:text-blue-500 transition-colors">
                                <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Direction Icon with pulse animation -->
                    <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-30"></span>
                            <i class="fa-solid fa-ship text-white text-lg"></i>
                        </div>
                    </div>

                    <!-- POD Selection -->
                    <div class="lg:col-span-5">
                        <label for="pod" class="block mb-2 text-sm font-bold text-gray-700">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-red-600 mr-2"></i>
                                Port of Discharge (POD)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pod" id="pod"
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 border-gray-200 hover:border-red-400 rounded-lg sm:rounded-xl focus:ring-4 focus:ring-red-100 focus:border-red-500 appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled selected>Select Port of Discharge</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pod') == $city ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 pointer-events-none text-gray-400 group-hover:text-red-500 transition-colors">
                                <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="lg:col-span-12 pt-2 sm:pt-4">
                        <button id="submitButton" type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 sm:py-4 px-6 sm:px-8 rounded-lg sm:rounded-xl hover:from-blue-500 hover:to-blue-800 transition-all duration-300 font-bold flex items-center justify-center text-base sm:text-lg shadow-lg hover:shadow-blue-200">
                            <span id="buttonText" class="mr-2">Find Available Ships</span>
                            <i class="fas fa-search"></i>
                            <span id="loadingSpinner" class="hidden ml-2">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Results Section -->
            @if (request('pol') && request('pod'))
                <div class="space-y-6 sm:space-y-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 sm:mb-8 gap-3">
                        <div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Available Shipments
                            </h2>
                            <p class="text-gray-500 mt-1">From {{ strtoupper(request('pol')) }} to
                                {{ strtoupper(request('pod')) }}</p>
                        </div>
                        <div
                            class="px-4 py-2 sm:px-5 sm:py-3 bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 rounded-full font-medium flex items-center shadow-sm text-sm sm:text-base">
                            <i class="fas fa-route mr-2"></i>
                            <span>{{ $shipments->count() }} routes found</span>
                        </div>
                    </div>

                    @if ($shipments->isEmpty())
                        <div
                            class="bg-white rounded-xl shadow-lg sm:shadow-xl p-6 sm:p-10 lg:p-16 text-center border border-gray-100">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-blue-50 rounded-full mb-4 sm:mb-6 animate-pulse">
                                <i class="fas fa-ship text-3xl sm:text-4xl lg:text-5xl text-blue-300"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No
                                Routes Available</h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">We couldn't
                                find any shipments
                                for the selected route. Please try different ports or check back later.</p>
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded-lg transition-colors">
                                <i class="fas fa-search mr-2"></i>
                                Try Another Route
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6 sm:gap-8">
                            @foreach ($shipments as $shipment)
                                <div
                                    class="bg-white rounded-xl shadow-md sm:shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.01] group">
                                    <!-- Shipment Card Header with gradient background -->
                                    <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 sm:p-6">
                                        <div class="absolute top-0 right-0 w-16 sm:w-20 h-16 sm:h-20">
                                            <div
                                                class="absolute transform rotate-45 bg-gradient-to-r from-green-500 to-green-400 text-center text-white font-semibold py-1 right-[-35px] top-[28px] sm:top-[32px] w-[170px] shadow-md text-xs sm:text-sm">
                                                Available</div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row justify-between items-start">
                                            <div>
                                                <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">
                                                    {{ $shipment->vessel_name }}
                                                </h3>
                                                <div class="flex items-center text-white text-sm sm:text-base lg:text-lg">
                                                    <span class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
                                                    <div class="flex items-center mx-2 sm:mx-3 space-x-1">
                                                        <span
                                                            class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-white rounded-full"></span>
                                                        <span class="w-10 sm:w-16 h-0.5 bg-white"></span>
                                                        <span
                                                            class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-white rounded-full"></span>
                                                    </div>
                                                    <span class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-4 sm:p-6 lg:p-8">
                                        <!-- Timeline with improved styling -->
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-lg sm:rounded-xl p-4 sm:p-6 mb-6 sm:mb-8 border border-gray-200 shadow-sm">
                                            <h4
                                                class="text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center">
                                                <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                                                Voyage Schedule
                                            </h4>

                                            <div class="relative">
                                                <!-- Timeline bar -->
                                                <div
                                                    class="hidden sm:block absolute top-1/2 left-0 right-0 h-1 bg-gray-200 transform -translate-y-1/2 z-0 mx-16 sm:mx-20">
                                                </div>

                                                <div
                                                    class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 lg:gap-10 relative">
                                                    @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                        <div
                                                            class="bg-white rounded-lg sm:rounded-xl p-3 sm:p-4 shadow-md border border-gray-100 relative z-10 group hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                                                            <div class="flex items-center justify-between mb-2 sm:mb-3">
                                                                <p
                                                                    class="text-xs sm:text-sm font-bold {{ $index == 0 ? 'text-blue-500' : ($index == 1 ? 'text-blue-600' : 'text-blue-700') }}">
                                                                    {{ strtoupper($timeKey) }}
                                                                </p>
                                                                <div
                                                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full {{ $index == 0 ? 'bg-blue-100 text-blue-500' : ($index == 1 ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gradient-to-r from-blue-600 to-blue-700 text-white') }} shadow-md group-hover:scale-110 transition-transform duration-300">
                                                                    <i
                                                                        class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-xs sm:text-sm"></i>
                                                                </div>
                                                            </div>
                                                            <p
                                                                class="font-bold text-gray-800 text-base sm:text-lg lg:text-xl">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                            </p>
                                                            <p
                                                                class="text-xs sm:text-sm text-gray-500 mt-1 flex items-center">
                                                                <i class="far fa-clock mr-1"></i>
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional shipment details with improved cards -->
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-6 sm:mb-8">
                                            <div
                                                class="bg-gradient-to-br from-gray-50 to-white p-3 sm:p-4 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                                <p class="text-xs text-gray-500 mb-1">Vessel Type</p>
                                                <p class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                    <i class="fas fa-ship text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
                                                    Container Ship
                                                </p>
                                            </div>
                                            <div
                                                class="bg-gradient-to-br from-gray-50 to-white p-3 sm:p-4 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                                <p class="text-xs text-gray-500 mb-1">Transit Time</p>
                                                <p class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                    <i class="fas fa-clock text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
                                                    {{ \Carbon\Carbon::parse($shipment->etb)->diffInDays(\Carbon\Carbon::parse($shipment->eta)) }}
                                                    Days
                                                </p>
                                            </div>
                                            <div
                                                class="bg-gradient-to-br from-gray-50 to-white p-3 sm:p-4 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                                <p class="text-xs text-gray-500 mb-1">Freetime</p>
                                                <p class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                    <i class="fas fa-stopwatch text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
                                                    5-7 Days
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Price and Book Now Button -->
                                        <div
                                            class="flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-6 border-t border-gray-100 pt-4 sm:pt-6">
                                            <div class="flex flex-col items-center sm:items-start">
                                                <p class="text-xs sm:text-sm text-gray-500 mb-1">Price per
                                                    Container</p>
                                                <div class="flex items-center">
                                                    <span class="text-xs sm:text-sm text-gray-500 mr-1 sm:mr-2">IDR</span>
                                                    <span
                                                        class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-700">
                                                        {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <div
                                                    class="flex items-center mt-1 sm:mt-2 text-green-600 text-xs sm:text-sm">
                                                    <i class="fas fa-tag mr-1"></i>
                                                    <span>Best available rate</span>
                                                </div>
                                            </div>

                                            <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}"
                                                class="w-full sm:w-auto inline-flex items-center justify-center px-5 sm:px-8 py-2.5 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-xl hover:from-blue-500 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-blue-200 group">
                                                Book Now
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 sm:h-5 sm:w-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <!-- Empty state when no search performed -->
                <div class="bg-white rounded-xl shadow-md p-8 text-center mt-8">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Start Your Search</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Select your departure and arrival ports above to find
                        available
                        shipments.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function handleFormSubmit(event) {
            event.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            event.target.submit();
        }
    </script>
@endsection
