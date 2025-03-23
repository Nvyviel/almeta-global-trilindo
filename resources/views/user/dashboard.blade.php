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

    <!-- Hero background with gradient -->
    <div class="relative pt-12 pb-16 overflow-hidden">
        <!-- Hero content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 tracking-tight">
                <span class="inline-block transform hover:scale-105 transition-transform duration-300">Find Your Perfect
                    Route</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-blue-700 max-w-2xl mx-auto">
                Search available shipments between ports for the best shipping solutions
            </p>
        </div>
    </div>

    <!-- Main container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 pb-16">
        <!-- Search Form with shadow and hover effects -->
        <form action="{{ route('filtering-shipment') }}" method="GET"
            class="bg-white rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 p-6 mb-12 relative overflow-hidden transform hover:-translate-y-1"
            onsubmit="handleFormSubmit(event)">

            <!-- Background decorations -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-70"></div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-100 rounded-full opacity-50"></div>
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-100 rounded-full opacity-50"></div>

            <!-- Form content -->
            <div class="relative">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                    <!-- POL Selection -->
                    <div class="md:col-span-5">
                        <label for="pol" class="block mb-2 text-sm font-semibold text-gray-700">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Port of Loading (POL)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pol" id="pol"
                                class="block w-full pl-4 pr-10 py-3 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white group-hover:border-blue-400 transition-colors duration-200">
                                <option disabled selected>Select Port of Loading</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pol') == $city ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-blue-500 group-hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Direction Icon with animation -->
                    <div class="hidden md:flex md:col-span-2 justify-center items-center">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center group hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600 group-hover:text-blue-700 transform group-hover:scale-110 transition-all duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- POD Selection -->
                    <div class="md:col-span-5">
                        <label for="pod" class="block mb-2 text-sm font-semibold text-gray-700">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Port of Discharge (POD)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pod" id="pod"
                                class="block w-full pl-4 pr-10 py-3 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white group-hover:border-blue-400 transition-colors duration-200">
                                <option disabled selected>Select Port of Discharge</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pod') == $city ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-blue-500 group-hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button with animation -->
                    <div class="md:col-span-12">
                        <button id="submitButton" type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 px-6 rounded-lg transition-all duration-300 font-semibold text-base flex items-center justify-center group focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <span id="buttonText" class="mr-2">Find Available Ships</span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                            <span id="loadingSpinner" class="hidden ml-2">
                                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Results Section -->
        @if (request('pol') && request('pod'))
            <div class="space-y-6">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Available Shipments</h2>
                            <p class="text-sm text-gray-500">From {{ strtoupper(request('pol')) }} to
                                {{ strtoupper(request('pod')) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 flex items-center">
                        <span
                            class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-800 text-sm font-medium rounded-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $shipments->count() }} routes found
                        </span>
                    </div>
                </div>

                @if ($shipments->isEmpty())
                    <!-- Empty state with animation -->
                    <div class="bg-white rounded-xl shadow-md p-8 text-center">
                        <div class="flex justify-center mb-6">
                            <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center animate-pulse">
                                <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Routes Available</h3>
                        <p class="text-gray-600 mb-6">We couldn't find any shipments for the selected route. Please try
                            different ports or dates.</p>
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Start New Search
                        </a>
                    </div>
                @else
                    <!-- Shipment cards with hover effects -->
                    <div class="grid grid-cols-1 gap-6">
                        @foreach ($shipments as $shipment)
                            <div
                                class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                                <div class="p-6">
                                    <!-- Header with Vessel Name and Status -->
                                    <div
                                        class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-100">
                                        <div class="flex items-center mb-4 sm:mb-0">
                                            <div class="bg-blue-100 rounded-full p-3 mr-4">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900">{{ $shipment->vessel_name }}
                                                </h3>
                                                <div class="flex items-center text-gray-600 mt-1">
                                                    <span
                                                        class="font-medium text-sm">{{ strtoupper($shipment->from_city) }}</span>
                                                    <div class="mx-2 flex items-center">
                                                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                                        <div class="w-10 h-0.5 bg-gray-300"></div>
                                                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                                    </div>
                                                    <span
                                                        class="font-medium text-sm">{{ strtoupper($shipment->to_city) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span
                                                class="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Available
                                            </span>
                                            <span class="ml-3 text-xs text-gray-500">
                                                Closing:
                                                {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y - H:i') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Timeline with improved design -->
                                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 mb-6">
                                        <div class="grid grid-cols-1 sm:grid-cols-5 gap-6 relative">
                                            <!-- Timeline connector -->
                                            {{-- <div
                                                class="hidden sm:block absolute top-1/2 left-0 right-0 h-1 bg-blue-200 -translate-y-1/2 ">
                                            </div> --}}
                                            <!-- Ship Icon -->
                                            <div class="flex justify-center items-center">
                                                <div
                                                    class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center shadow-md">
                                                    <svg class="w-8 h-8 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Timeline Items with hover effects -->
                                            <!-- ETB -->
                                            <div
                                                class="group bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 transform">
                                                <div class="text-center">
                                                    <span
                                                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full mb-2">ETB</span>
                                                    <p
                                                        class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                                        {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($shipment->etb)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- ETD -->
                                            <div
                                                class="group bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 transform">
                                                <div class="text-center">
                                                    <span
                                                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full mb-2">ETD</span>
                                                    <p
                                                        class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                                        {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($shipment->etd)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- ETA -->
                                            <div
                                                class="group bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 transform">
                                                <div class="text-center">
                                                    <span
                                                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full mb-2">ETA</span>
                                                    <p
                                                        class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                                        {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($shipment->eta)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Destination Icon -->
                                            <div class="flex justify-center items-center">
                                                <div
                                                    class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center shadow-md">
                                                    <svg class="w-8 h-8 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price and Book Now Button -->
                                    <div
                                        class="flex flex-col sm:flex-row items-center justify-between mt-6 bg-gray-50 rounded-lg p-4">
                                        <div class="text-center sm:text-left mb-4 sm:mb-0">
                                            <p class="text-sm text-gray-500 mb-1">Price per Container</p>
                                            <p class="text-3xl font-bold text-blue-700">
                                                Rp {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}" wire:navigate
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-semibold text-base rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                            Book Now
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
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
                <p class="text-gray-600 max-w-md mx-auto">Select your departure and arrival ports above to find available
                    shipments.</p>
            </div>
        @endif
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
