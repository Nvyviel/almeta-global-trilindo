<x-guest-layout>
    @section('title-guest', 'Almeta Global Trilindo')

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

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 relative">
        <!-- Background elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 right-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] bg-gradient-to-bl from-red-100/30 to-transparent rounded-full blur-3xl animate-pulse duration-7000">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] bg-gradient-to-tr from-blue-100/30 to-transparent rounded-full blur-3xl animate-pulse duration-7000">
            </div>
        </div>

        <!-- Navigation -->
        <nav
            class="border-b border-gray-100 backdrop-blur-lg bg-white/90 fixed w-full top-0 z-50 shadow-sm transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <div class="flex items-center">
                        <a href="#" class="flex items-center space-x-3 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center text-white font-bold group-hover:scale-110 transition-all duration-300">
                                PT</div>
                            <span
                                class="text-lg md:text-xl font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent group-hover:from-red-700 group-hover:to-red-900 transition-all duration-300">Almeta
                                Global Trilindo</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" wire:navigate
                            class="group relative inline-flex items-center px-6 py-2.5 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:text-white overflow-hidden transition-all duration-300">
                            <span
                                class="absolute inset-0 bg-blue-600 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                            <span class="relative flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                <span>Login</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden pt-20 md:pt-24">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-red-50 opacity-70"></div>
            <!-- Animated Circles -->
            <div
                class="absolute top-32 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-32 right-10 w-64 h-64 bg-red-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-32 left-1/3 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-20 sm:py-28 lg:py-32">
                    <div class="text-center">
                        <div class="mb-6 inline-block relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-700 rounded-full blur-xl opacity-20 animate-pulse">
                            </div>
                            <h1
                                class="text-6xl sm:text-7xl lg:text-8xl font-black tracking-tight relative animate-fade-in">
                                <span
                                    class="bg-gradient-to-r from-red-600 via-red-700 to-red-800 bg-clip-text text-transparent">
                                    ALMETA
                                </span>
                            </h1>
                        </div>
                        <p
                            class="mt-8 max-w-3xl mx-auto text-xl sm:text-2xl text-gray-700 leading-relaxed font-light animate-fade-in-up">
                            <span class="relative inline-block">
                                <span
                                    class="absolute bottom-0 left-0 right-0 h-3 bg-yellow-200 opacity-30 transform -rotate-1"></span>
                                <span class="relative">Fast, Safe, and Reliable</span>
                            </span>
                            Domestic Logistics solutions for your business.
                        </p>
                        <p
                            class="mt-4 max-w-2xl mx-auto text-base sm:text-lg text-gray-500 leading-relaxed animate-fade-in-up delay-200">
                            In a fast-paced business world, small and medium industries (IKM) need fast, safe and
                            reliable logistics solutions.
                        </p>
                        <div
                            class="mt-10 sm:mt-12 flex flex-col sm:flex-row justify-center gap-4 px-4 animate-fade-in-up delay-300">
                            <a href="#filtering"
                                class="group inline-flex items-center justify-center px-8 py-3.5 text-lg font-semibold rounded-full text-white bg-gradient-to-r from-red-600 to-red-700 shadow-lg hover:shadow-red-500/30 transform transition-all duration-300 hover:-translate-y-1">
                                <span>Search Route</span>
                                <i class="fas fa-search ml-2 group-hover:ml-3 transition-all duration-300"></i>
                            </a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="group inline-flex items-center justify-center px-8 py-3.5 text-lg font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg hover:shadow-blue-500/30 transform transition-all duration-300 hover:-translate-y-1">
                                <span>Get Started</span>
                                <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="relative z-10 py-16 sm:py-20 bg-gradient-to-b from-white/80 to-blue-50/70 backdrop-blur-sm"
            id="filtering">
            <!-- Decorative elements -->
            <div
                class="absolute top-0 left-0 w-full h-64 bg-gradient-to-r from-blue-100/20 to-red-100/20 blur-3xl opacity-70">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-bl from-blue-200/20 to-transparent rounded-full blur-3xl">
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-10 sm:mb-14">
                    <span
                        class="inline-block px-4 py-1.5 bg-blue-100 text-blue-800 text-sm font-medium rounded-full mb-3">Search
                        Routes</span>
                    <h2
                        class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3 bg-clip-text text-transparent bg-gradient-to-r from-blue-800 to-blue-600">
                        Find Your Perfect Shipping Route
                    </h2>
                    <p class="text-gray-600 text-lg sm:text-xl max-w-2xl mx-auto">Select ports and discover available
                        shipments with competitive rates</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('landing-page') }}" method="GET"
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-5 sm:p-10 mb-16 relative overflow-hidden border border-gray-100"
                    onsubmit="handleFormSubmit(event)">
                    <!-- Glass effect background -->
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50/80 via-white/80 to-red-50/80 opacity-70">
                    </div>

                    <!-- Decorative circles -->
                    <div class="absolute -top-20 -left-20 w-64 h-64 bg-blue-100 rounded-full opacity-20"></div>
                    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-red-100 rounded-full opacity-20"></div>

                    <div class="relative">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-8 items-end">
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
                                        class="block w-full pl-4 pr-12 py-4 border-2 border-gray-200 group-hover:border-blue-400 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 appearance-none bg-white shadow-sm transition-all duration-300">
                                        <option disabled selected>Select Port of Loading</option>
                                        @foreach ($fromCities as $city)
                                            <option value="{{ $city }}"
                                                {{ request('pol') == $city ? 'selected' : '' }}>
                                                {{ strtoupper($city) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 group-hover:text-blue-500 transition-colors duration-300">
                                        <i class="fas fa-chevron-down text-base"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Direction Icon -->
                            <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-200 animate-pulse duration-2000">
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
                                        class="block w-full pl-4 pr-12 py-4 border-2 border-gray-200 group-hover:border-red-400 rounded-xl focus:ring-4 focus:ring-red-100 focus:border-red-500 appearance-none bg-white shadow-sm transition-all duration-300">
                                        <option disabled selected>Select Port of Discharge</option>
                                        @foreach ($fromCities as $city)
                                            <option value="{{ $city }}"
                                                {{ request('pod') == $city ? 'selected' : '' }}>
                                                {{ strtoupper($city) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 group-hover:text-red-500 transition-colors duration-300">
                                        <i class="fas fa-chevron-down text-base"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="lg:col-span-12 pt-4">
                                <button id="submitButton" type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white py-4 px-8 rounded-xl hover:from-blue-700 hover:to-blue-900 transition-all duration-300 font-bold flex items-center justify-center group text-lg shadow-lg shadow-blue-200/50 hover:shadow-blue-300/50 transform hover:-translate-y-1">
                                    <span id="buttonText" class="mr-2">Find Available Ships</span>
                                    <span class="relative flex h-3 w-3 mr-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                                    </span>
                                    <span id="loadingSpinner" class="hidden ml-2">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Results Section -->
                @if (request('pol') && request('pod'))
                    <div class="space-y-8 sm:space-y-10">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Available Shipments</h2>
                                <p class="text-gray-500 mt-1">From {{ strtoupper(request('pol')) }} to
                                    {{ strtoupper(request('pod')) }}</p>
                            </div>
                            <div
                                class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium flex items-center">
                                <i class="fas fa-route mr-2"></i>
                                <span>{{ $shipments->count() }} routes found</span>
                            </div>
                        </div>

                        @if ($shipments->isEmpty())
                            <div
                                class="bg-white rounded-2xl shadow-xl p-10 sm:p-16 text-center border border-gray-100">
                                <div
                                    class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-6">
                                    <i class="fas fa-ship text-5xl text-blue-300"></i>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">No Routes Available</h3>
                                <p class="text-gray-600 text-lg max-w-md mx-auto mb-6">We couldn't find any shipments
                                    for the selected route. Please try different ports or check back later.</p>
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded-lg transition-colors duration-300">
                                    <i class="fas fa-search mr-2"></i>
                                    Try Another Route
                                </a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-8">
                                @foreach ($shipments as $shipment)
                                    <div
                                        class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1 border border-gray-100">
                                        <!-- Shipment Card Header with ribbon -->
                                        <div
                                            class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                                            <div class="absolute top-0 right-0 w-20 h-20">
                                                <div
                                                    class="absolute transform rotate-45 bg-green-500 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px]">
                                                    Available</div>
                                            </div>

                                            <div class="flex flex-col sm:flex-row justify-between items-start">
                                                <div>
                                                    <h3 class="text-2xl sm:text-3xl font-bold mb-2">
                                                        {{ $shipment->vessel_name }}
                                                    </h3>
                                                    <div class="flex items-center text-blue-100 text-lg">
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
                                                        <div class="flex items-center mx-3 space-x-1">
                                                            <span class="w-2 h-2 bg-blue-100 rounded-full"></span>
                                                            <span class="w-12 h-0.5 bg-blue-100"></span>
                                                            <span class="w-2 h-2 bg-blue-100 rounded-full"></span>
                                                        </div>
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                                    </div>
                                                </div>
                                                {{-- <div
                                                    class="mt-4 mr-20 sm:mt-0 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg">
                                                    <p class="text-sm font-medium">
                                                        {{ strtoupper(substr(md5($shipment->id), 0, 8)) }}</p>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="p-6 sm:p-8">
                                            <!-- Timeline -->
                                            <div
                                                class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 mb-8 border border-blue-100">
                                                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                                    <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                                                    Voyage Schedule
                                                </h4>

                                                <div class="relative">
                                                    <!-- Timeline line -->
                                                    <div
                                                        class="hidden sm:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-blue-300 via-blue-500 to-blue-700">
                                                    </div>

                                                    <div
                                                        class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-10 relative">
                                                        @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                            <div
                                                                class="bg-white rounded-xl p-4 shadow-md border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 relative z-10">
                                                                <!-- Timeline circle indicator -->
                                                                <div
                                                                    class="hidden sm:flex absolute top-1/2 {{ $index == 0 ? 'left-0 -translate-x-1/2' : ($index == 2 ? 'right-0 translate-x-1/2' : 'left-1/2 -translate-x-1/2') }} transform -translate-y-1/2 w-6 h-6 bg-white rounded-full border-4 {{ $index == 0 ? 'border-blue-300' : ($index == 1 ? 'border-blue-500' : 'border-blue-700') }} shadow-md">
                                                                </div>

                                                                <div class="flex items-center justify-between mb-3">
                                                                    <p
                                                                        class="text-sm font-bold {{ $index == 0 ? 'text-blue-500' : ($index == 1 ? 'text-blue-600' : 'text-blue-700') }}">
                                                                        {{ strtoupper($timeKey) }}
                                                                    </p>
                                                                    <div
                                                                        class="flex items-center justify-center w-8 h-8 rounded-full {{ $index == 0 ? 'bg-blue-100 text-blue-500' : ($index == 1 ? 'bg-blue-500 text-white' : 'bg-blue-700 text-white') }}">
                                                                        <i
                                                                            class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }}"></i>
                                                                    </div>
                                                                </div>
                                                                <p class="font-bold text-gray-800 text-xl">
                                                                    {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                                </p>
                                                                <p
                                                                    class="text-sm text-gray-500 mt-1 flex items-center">
                                                                    <i class="far fa-clock mr-1"></i>
                                                                    {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Additional shipment details -->
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-xs text-gray-500 mb-1">Vessel Type</p>
                                                    <p class="font-medium">Container Ship</p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-xs text-gray-500 mb-1">Transit Time</p>
                                                    <p class="font-medium">
                                                        {{ \Carbon\Carbon::parse($shipment->etb)->diffInDays(\Carbon\Carbon::parse($shipment->eta)) }}
                                                        Days
                                                    </p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-xs text-gray-500 mb-1">Container Type</p>
                                                    <p class="font-medium">Standard 20ft</p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-xs text-gray-500 mb-1">Distance</p>
                                                    <p class="font-medium">{{ rand(500, 2000) }} nm</p>
                                                </div>
                                            </div>

                                            <!-- Price and Book Now Button -->
                                            <div
                                                class="flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0 border-t border-gray-100 pt-6">
                                                <div class="flex flex-col items-center sm:items-start">
                                                    <p class="text-sm text-gray-500 mb-1">Price per Container</p>
                                                    <div class="flex items-center">
                                                        <span class="text-sm text-gray-500 mr-2">IDR</span>
                                                        <span
                                                            class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                                                            {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center mt-2 text-green-600 text-sm">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        <span>Best available rate</span>
                                                    </div>
                                                </div>

                                                <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}"
                                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-blue-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 group">
                                                    Book Now
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Add to your existing styles section -->
        <style>
            @keyframes pulse-custom {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }
            }

            .animate-pulse {
                animation: pulse-custom 2s ease-in-out infinite;
            }

            .duration-2000 {
                animation-duration: 2000ms;
            }
        </style>

        <!-- Features Section -->
        <div
            class="relative z-10 py-16 sm:py-24 backdrop-blur-sm bg-gradient-to-b from-transparent to-white/50 overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-100/30 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-12 sm:mb-20">
                    <span
                        class="inline-block px-4 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-full mb-3">Our
                        Promise</span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">Why Choose Almeta?</h2>
                    <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Experience superior logistics
                        services tailored for businesses across Indonesia</p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16 sm:mb-20">
                    <div
                        class="p-6 text-center bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="text-4xl font-bold text-red-600 mb-2">10+</div>
                        <div class="text-gray-500">Major Ports</div>
                    </div>
                    <div
                        class="p-6 text-center bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="text-4xl font-bold text-blue-600 mb-2">98%</div>
                        <div class="text-gray-500">On-Time Delivery</div>
                    </div>
                    <div
                        class="p-6 text-center bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="text-4xl font-bold text-green-600 mb-2">4.9<span class="text-xl">/5</span></div>
                        <div class="text-gray-500">Client Rating</div>
                    </div>
                    <div
                        class="p-6 text-center bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="text-4xl font-bold text-yellow-600 mb-2">24/7</div>
                        <div class="text-gray-500">Support</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 lg:gap-14">
                    <!-- Feature 1 -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-400 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-500">
                        </div>
                        <div
                            class="relative p-6 sm:p-8 rounded-2xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute right-0 top-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16"></div>
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300 relative">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4 relative">Fast Delivery
                            </h3>
                            <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4 relative">Quick and
                                efficient logistics solutions to meet your business needs with guaranteed timely
                                delivery.</p>
                            <div
                                class="flex items-center text-red-600 font-medium relative cursor-pointer group-hover:text-red-700 transition-colors">
                                <span>Learn more</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative mt-6 md:mt-12">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-500">
                        </div>
                        <div
                            class="relative p-6 sm:p-8 rounded-2xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16"></div>
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300 relative">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4 relative">Safe & Secure
                            </h3>
                            <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4 relative">Your cargo's
                                safety is our top priority with comprehensive end-to-end security measures.</p>
                            <div
                                class="flex items-center text-blue-600 font-medium relative cursor-pointer group-hover:text-blue-700 transition-colors">
                                <span>Learn more</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-green-600 to-green-400 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-500">
                        </div>
                        <div
                            class="relative p-6 sm:p-8 rounded-2xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute right-0 top-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16"></div>
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300 relative">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4 relative">Reliable
                                Service</h3>
                            <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4 relative">Consistent and
                                dependable logistics solutions you can count on, backed by years of experience.</p>
                            <div
                                class="flex items-center text-green-600 font-medium relative cursor-pointer group-hover:text-green-700 transition-colors">
                                <span>Learn more</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="mt-16 sm:mt-20 bg-gradient-to-r from-blue-50 to-red-50 p-6 sm:p-10 rounded-3xl shadow-sm">
                    <div class="flex flex-col items-center">
                        <div class="flex space-x-1 mb-4">
                            {!! str_repeat(
                                '<svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>',
                                5,
                            ) !!}
                        </div>
                        <p class="text-xl sm:text-2xl text-center text-gray-700 font-medium mb-6 italic">"Almeta has
                            transformed how we manage our supply chain. Their reliable service and professional team
                            make shipping easy."</p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-lg mr-3">
                                P</div>
                            <div>
                                <div class="font-medium">PT. Pacific Industries</div>
                                <div class="text-sm text-gray-500">Satisfied Customer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative z-10 bg-gradient-to-b from-gray-50 to-gray-100 text-black py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo and Description -->
                <div class="flex flex-col items-center text-center mb-10 sm:mb-16">
                    <a href="#"
                        class="text-2xl font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent mb-4">
                        PT. Almeta Global Trilindo
                    </a>
                    <p class="max-w-md text-gray-600">Your trusted partner in domestic logistics solutions since 2020,
                        providing fast, safe and reliable shipping services throughout Indonesia.</p>
                </div>

                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 sm:gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-5">
                        <h3 class="text-xl font-bold text-black mb-6 relative">
                            Contact Information
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-red-500 rounded-full -mb-2"></span>
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start group">
                                <div
                                    class="mr-4 p-3 bg-red-50 rounded-lg group-hover:bg-red-100 transition-all transform group-hover:scale-110 duration-300">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Address</h4>
                                    <p class="text-gray-600">Jasamarga Green Residence AD. 6 No. 7 Sidoarjo, East Java
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div
                                    class="mr-4 p-3 bg-red-50 rounded-lg group-hover:bg-red-100 transition-all transform group-hover:scale-110 duration-300">
                                    <i class="fas fa-phone text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Phone</h4>
                                    <p class="text-gray-600 hover:text-red-600 transition-colors duration-300">
                                        <a href="tel:+6281216996352">+62 812-1699-6352</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information -->
                    <div class="space-y-5">
                        <h3 class="text-xl font-bold text-black mb-6 relative">
                            Email Us
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-blue-500 rounded-full -mb-2"></span>
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start group">
                                <div
                                    class="mr-4 p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-all transform group-hover:scale-110 duration-300">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Company</h4>
                                    <p class="text-gray-600 hover:text-blue-600 transition-colors duration-300">
                                        <a href="mailto:almetagt@gmail.com">almetagt@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div
                                    class="mr-4 p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-all transform group-hover:scale-110 duration-300">
                                    <i class="fas fa-headset text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Customer Service</h4>
                                    <p class="text-gray-600 hover:text-blue-600 transition-colors duration-300">
                                        <a href="mailto:aldivo.ishen@gmail.com">aldivo.ishen@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Subscription -->
                    <div class="space-y-5">
                        <h3 class="text-xl font-bold text-black mb-6 relative">
                            Stay Updated
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-green-500 rounded-full -mb-2"></span>
                        </h3>
                        <p class="text-gray-600 mb-4">Subscribe to our newsletter for updates on services, promotions
                            and shipping news.</p>
                        <form class="space-y-3">
                            <div class="relative">
                                <input type="email" placeholder="Your email address"
                                    class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-md transition-colors duration-300">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Social Media Links -->
                        <div class="mt-6">
                            <p class="text-sm font-medium text-gray-700 mb-3">Follow us</p>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-twitter text-blue-400"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-red-100 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-instagram text-red-500"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-linkedin-in text-blue-700"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-10"></div>

                <!-- Bottom Footer -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-500">&copy; 2024 PT. ALMETA GLOBAL TRILINDO. All rights reserved.
                        </p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#"
                            class="text-sm text-gray-500 hover:text-red-600 transition-colors duration-300">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-sm text-gray-500 hover:text-red-600 transition-colors duration-300">Terms of
                            Service</a>
                        <a href="#"
                            class="text-sm text-gray-500 hover:text-red-600 transition-colors duration-300">FAQ</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Animations -->
        <style>
            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }

                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            .animation-delay-4000 {
                animation-delay: 4s;
            }

            @keyframes pulse-custom {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }
            }

            .hover-pulse:hover {
                animation: pulse-custom 1.5s ease-in-out infinite;
            }

            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-gradient {
                background-size: 200% auto;
                animation: gradient 4s ease infinite;
            }

            .animate-fade-in {
                animation: fadeIn 1s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 1s ease-out;
            }

            .duration-7000 {
                animation-duration: 7000ms;
            }

            .delay-200 {
                animation-delay: 200ms;
            }

            .delay-300 {
                animation-delay: 300ms;
            }
        </style>

        <!-- Form submission script -->
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
    </div>
</x-guest-layout>
