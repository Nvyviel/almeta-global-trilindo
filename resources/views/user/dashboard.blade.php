@extends('layouts.main')
@section('component')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl mb-2">Find your perfect route</h1>
        <p class="text-gray-600">Search available shipments between ports</p>
    </div>

    <!-- Search Form -->
    <form action="{{ route('filtering-shipment') }}" method="GET" class="bg-white rounded-2xl shadow-lg p-6 mb-12 relative overflow-hidden" onsubmit="handleFormSubmit(event)">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-50"></div>
    
    <div class="relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end">
            <!-- POL Selection -->
            <div class="lg:col-span-5">
                <label for="pol" class="block mb-2 text-sm font-medium text-gray-700">Port of Loading (POL)</label>
                <div class="relative">
                    <select name="pol" id="pol" class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                        <option disabled selected>Select Port of Loading</option>
                        @php
                            $fromCities = ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon'];
                        @endphp
                        @foreach ($fromCities as $city)
                            <option value="{{ $city }}" {{ request('pol') == $city ? 'selected' : '' }}>
                                {{ strtoupper($city) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                        <i class="fas fa-anchor"></i>
                    </div>
                </div>
            </div>

            <!-- Direction Icon -->
            <div class="hidden lg:flex lg:col-span-2 justify-center items-center pb-3">
                <i class="fa-solid fa-arrow-right-long text-lg text-blue-500"></i>
            </div>

            <!-- POD Selection -->
            <div class="lg:col-span-5">
                <label for="pod" class="block mb-2 text-sm font-medium text-gray-700">Port of Discharge (POD)</label>
                <div class="relative">
                    <select name="pod" id="pod" class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                        <option disabled selected>Select Port of Discharge</option>
                        @foreach ($fromCities as $city)
                            <option value="{{ $city }}" {{ request('pod') == $city ? 'selected' : '' }}>
                                {{ strtoupper($city) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                        <i class="fas fa-anchor"></i>
                    </div>
                </div>
            </div>

            <!-- Search Button -->
            <div class="lg:col-span-12">
                <button id="submitButton" type="submit" class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium flex items-center justify-center group">
                    <span id="buttonText">Find Available Ships</span>
                    <i class="fa-solid fa-ship ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    <span id="loadingSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>

    <!-- Results Section -->
    @if(request('pol') && request('pod'))
        <div class="space-y-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Available Shipments</h2>
                <div class="text-sm text-gray-500">
                    {{ $shipments->count() }} routes found
                </div>
            </div>

            @if($shipments->isEmpty())
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <div class="text-gray-400 mb-3">
                        <i class="fas fa-ship text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No routes Available</h3>
                    <p class="text-gray-600">No shipments found for the selected route. Please try different ports or dates.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($shipments as $shipment)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                            <div class="p-6">
                                <!-- Header -->
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $shipment->vessel_name }}</h3>
                                        <div class="flex items-center text-gray-600">
                                            <span class="font-medium">{{ strtoupper($shipment->from_city) }} </span>
                                            {{-- <i class="fas fa-arrow-right mx-3 text-blue-500"></i> --}}
                                            <p class="text-gray-600 mx-2 text-md"> ----> </p>
                                            <span class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Available</span>
                                </div>

                                <!-- Timeline Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500">Closing Cargo</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('H:i') }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500">ETB</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($shipment->etb)->format('H:i') }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500">ETD</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($shipment->etd)->format('H:i') }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500">ETA</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($shipment->eta)->format('H:i') }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-6">
                                    <div class="text-right flex-1">
                                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($shipment->rate_per_container, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">/ Container</p>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-4 text-right">
                                    <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}" wire:navigate
                                    class="inline-flex items-center px-6 py-2.5 bg-gray-300 text-gray-800 font-medium text-sm rounded-full hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 transition-colors duration-200">
                                        Book Now 
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-compass text-6xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Find Your Route</h3>
            <p class="text-gray-600">Select your ports above to see available shipments</p>
        </div>
    @endif
</div>

<script>
    function handleFormSubmit(event) {
        // Prevent default form submission
        event.preventDefault();

        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        // Disable the button and show the loading spinner
        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');

        // Optionally, submit the form after the animation starts
        event.target.submit();
    }
</script>
@endsection