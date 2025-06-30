<x-guest-layout>
    @section('title-guest', 'Almeta Global Logistics')

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

    <div class="min-h-screen bg-white relative overflow-hidden">
        <!-- Navigation -->
        <nav class="border-b border-gray-100 bg-white fixed w-full top-0 z-50 shadow-sm backdrop-blur-md bg-white/95">
            <div class="w-full mx-auto">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <div class="flex items-center">
                        <a href="#" class="text-xl md:text-2xl font-extrabold text-red-600 flex items-center">
                            ALMETA
                        </a>
                    </div>

                    <!-- Perbaikan untuk navigasi mobile -->
                    <nav
                        class="border-b border-gray-100 bg-white fixed w-full top-0 z-50 shadow-sm backdrop-blur-md bg-white/95">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between items-center h-16 md:h-20">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-xl md:text-2xl font-extrabold text-red-600 flex items-center">
                                        ALMETA
                                    </a>
                                </div>

                                <!-- Desktop Navigation Links -->
                                <div class="hidden md:flex items-center space-x-8">
                                    <a href="#"
                                        class="text-gray-600 hover:text-red-600 font-medium transition-colors">Home</a>
                                    <a href="#filtering"
                                        class="text-gray-600 hover:text-red-600 font-medium transition-colors">Find
                                        Routes</a>
                                    <a href="#features"
                                        class="text-gray-600 hover:text-red-600 font-medium transition-colors">Why
                                        Us</a>
                                    <a href="#contact"
                                        class="text-gray-600 hover:text-red-600 font-medium transition-colors">Contact</a>
                                </div>

                                <!-- Mobile Menu Button -->
                                <div class="md:hidden flex items-center">
                                    <button type="button" id="mobile-menu-button"
                                        class="text-gray-600 hover:text-red-600 focus:outline-none p-2">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="hidden md:flex items-center space-x-4">
                                    <a href="{{ route('login') }}" wire:navigate
                                        class="inline-flex items-center px-4 md:px-6 py-2 md:py-2.5 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-blue-200">
                                        <i class="fas fa-user mr-2"></i>
                                        <span>Login</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Mobile Navigation Menu (Separate from nav element) -->
                    <div id="mobile-menu"
                        class="hidden fixed top-16 left-0 right-0 z-40 bg-white border-b border-gray-200 shadow-lg animate-fade-in">
                        <div class="px-4 py-3 space-y-2">
                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Home</a>
                            <a href="#filtering"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Find
                                Routes</a>
                            <a href="#features"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Why
                                Us</a>
                            <a href="#contact"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Contact</a>
                            <div class="pt-2 pb-1">
                                <a href="{{ route('login') }}" wire:navigate
                                    class="inline-flex w-full items-center justify-center px-4 py-2 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Login</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section with animated background -->
        <div class="pt-20 md:pt-24 bg-blue-600 relative">
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="py-10 sm:py-12 lg:py-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Left side - Text content -->
                        <div class="text-left">
                            <h1
                                class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-blue-100 drop-shadow-sm pb-2 mb-2 animate-fade-in">
                                Almeta Logistics
                            </h1>
                            <p
                                class="text-xl sm:text-2xl font-bold text-white mb-4 md:mb-6 animate-fade-in animation-delay-300">
                                Management
                            </p>
                            <div class="animate-fade-in animation-delay-600">
                                <p class="text-lg sm:text-xl text-white leading-relaxed font-light mb-3 md:mb-4">
                                    <span class="border-b-4 border-yellow-300 pb-1">Fast, Safe, and Reliable</span>
                                    <span class="hidden sm:inline"> Domestic Logistics solutions for your
                                        business.</span>
                                </p>
                                <p class="sm:hidden text-white leading-relaxed font-light mb-3">
                                    Domestic Logistics solutions for your business.
                                </p>
                                <p class="text-sm sm:text-base text-blue-100 leading-relaxed max-w-lg">
                                    In a fast-paced business world, small and medium industries (IKM) need fast, safe
                                    and reliable logistics solutions.
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-3 animate-fade-up">
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-5 py-2.5 sm:px-6 sm:py-3 text-base sm:text-lg font-semibold rounded-lg text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 shadow-lg hover:shadow-red-200/50 transition-all duration-300 w-full sm:w-auto"
                                    style="position: relative; z-index: 10;">
                                    Search Route
                                    <i class="fas fa-search ml-2"></i>
                                </a>
                                <a href="{{ route('register') }}" wire:navigate
                                    class="inline-flex items-center justify-center px-5 py-2.5 sm:px-6 sm:py-3 text-base sm:text-lg font-semibold rounded-lg text-blue-600 bg-white hover:bg-blue-50 shadow-lg hover:shadow-blue-200/50 transition-all duration-300 w-full sm:w-auto"
                                    style="position: relative; z-index: 10;">
                                    Get Started
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Right side - Image -->
                        <div class="flex justify-center lg:justify-end mt-4 lg:mt-0">
                            <div
                                class="relative w-4/5 sm:w-2/3 lg:w-full max-w-sm aspect-square overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                                <img src="{{ asset('assets/img/Almeta-ship.png') }}" alt="Almeta Ship"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave separator -->
            <div class="absolute bottom-[-2px] left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
                    <path fill="#ffffff" fill-opacity="1"
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Search Section -->
        <div class="py-12 sm:py-16 lg:py-24 bg-white relative" id="filtering">
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
                <form action="{{ route('landing-page') }}#filtering" method="GET"
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
                                        <option value="{{ $city }}"
                                            {{ request('pol') == $city ? 'selected' : '' }}>
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
                                        <option value="{{ $city }}"
                                            {{ request('pod') == $city ? 'selected' : '' }}>
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
                        <div class="lg:col-span-12 pt-2 sm:pt-4" id="filtering">
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
                                        <div
                                            class="relative bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 sm:p-6">
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
                                                    <div
                                                        class="flex items-center text-white text-sm sm:text-base lg:text-lg">
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
                                                        <div class="flex items-center mx-2 sm:mx-3 space-x-1">
                                                            <span
                                                                class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-white rounded-full"></span>
                                                            <span class="w-10 sm:w-16 h-0.5 bg-white"></span>
                                                            <span
                                                                class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-white rounded-full"></span>
                                                        </div>
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
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
                                                                <div
                                                                    class="flex items-center justify-between mb-2 sm:mb-3">
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
                                                    <p
                                                        class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                        <i
                                                            class="fas fa-ship text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
                                                        Container Ship
                                                    </p>
                                                </div>
                                                <div
                                                    class="bg-gradient-to-br from-gray-50 to-white p-3 sm:p-4 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                                    <p class="text-xs text-gray-500 mb-1">Transit Time</p>
                                                    <p
                                                        class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                        <i
                                                            class="fas fa-clock text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
                                                        {{ \Carbon\Carbon::parse($shipment->etb)->diffInDays(\Carbon\Carbon::parse($shipment->eta)) }}
                                                        Days
                                                    </p>
                                                </div>
                                                <div
                                                    class="bg-gradient-to-br from-gray-50 to-white p-3 sm:p-4 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                                    <p class="text-xs text-gray-500 mb-1">Freetime </p>
                                                    <p
                                                        class="font-medium text-gray-800 flex items-center text-xs sm:text-sm">
                                                        <i
                                                            class="fas fa-box text-blue-500 mr-1.5 sm:mr-2 opacity-75"></i>
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
                                                        <span
                                                            class="text-xs sm:text-sm text-gray-500 mr-1 sm:mr-2">IDR</span>
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

        <!-- Features Section with improved styling and color scheme -->
        <div class="py-16 sm:py-20 lg:py-28" id="features">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16 lg:mb-24">
                    <div class="relative inline-block">
                        <span
                            class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white text-sm sm:text-base font-medium rounded-full mb-3 sm:mb-4 shadow-md">Our
                            Promise</span>
                        <div
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-red-500 to-orange-400 rounded-full">
                        </div>
                    </div>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-600 mb-4 sm:mb-6">
                        Why Choose Almeta?</h2>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">Experience superior
                        logistics services tailored for businesses across Indonesia</p>
                </div>

                <!-- Stats with improved gradient cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-16 sm:mb-20">
                    <div
                        class="p-5 sm:p-6 lg:p-8 text-center bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg border border-blue-100 hover:shadow-xl transition-all duration-500 transform hover:scale-[1.03] relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-600/5 to-red-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="inline-flex items-center justify-center w-14 h-14 sm:w-18 sm:h-18 bg-gradient-to-br from-red-600 to-red-400 rounded-2xl mb-4 sm:mb-5 shadow-lg group-hover:shadow-red-200/50 transform group-hover:scale-110 transition-all duration-500">
                                <i class="fas fa-anchor text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <div
                                class="text-3xl sm:text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400 mb-2 sm:mb-3">
                                10+</div>
                            <div class="text-sm sm:text-base text-gray-700 font-medium">Major Ports</div>
                        </div>
                    </div>

                    <div
                        class="p-5 sm:p-6 lg:p-8 text-center bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg border border-blue-100 hover:shadow-xl transition-all duration-500 transform hover:scale-[1.03] relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-blue-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="inline-flex items-center justify-center w-14 h-14 sm:w-18 sm:h-18 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl mb-4 sm:mb-5 shadow-lg group-hover:shadow-blue-200/50 transform group-hover:scale-110 transition-all duration-500">
                                <i class="fas fa-stopwatch text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <div
                                class="text-3xl sm:text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400 mb-2 sm:mb-3">
                                98%</div>
                            <div class="text-sm sm:text-base text-gray-700 font-medium">On-Time Delivery</div>
                        </div>
                    </div>

                    <div
                        class="p-5 sm:p-6 lg:p-8 text-center bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg border border-blue-100 hover:shadow-xl transition-all duration-500 transform hover:scale-[1.03] relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-600/5 to-green-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="inline-flex items-center justify-center w-14 h-14 sm:w-18 sm:h-18 bg-gradient-to-br from-green-600 to-green-400 rounded-2xl mb-4 sm:mb-5 shadow-lg group-hover:shadow-green-200/50 transform group-hover:scale-110 transition-all duration-500">
                                <i class="fas fa-star text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <div
                                class="text-3xl sm:text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 mb-2 sm:mb-3">
                                4.9<span class="text-xl sm:text-2xl">/5</span></div>
                            <div class="text-sm sm:text-base text-gray-700 font-medium">Client Rating</div>
                        </div>
                    </div>

                    <div
                        class="p-5 sm:p-6 lg:p-8 text-center bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg border border-blue-100 hover:shadow-xl transition-all duration-500 transform hover:scale-[1.03] relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-yellow-600/5 to-yellow-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="inline-flex items-center justify-center w-14 h-14 sm:w-18 sm:h-18 bg-gradient-to-br from-yellow-500 to-yellow-300 rounded-2xl mb-4 sm:mb-5 shadow-lg group-hover:shadow-yellow-200/50 transform group-hover:scale-110 transition-all duration-500">
                                <i class="fas fa-headset text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <div
                                class="text-3xl sm:text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-yellow-400 mb-2 sm:mb-3">
                                24/7</div>
                            <div class="text-sm sm:text-base text-gray-700 font-medium">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Feature cards with improved design -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 lg:gap-12 relative">
                    <!-- Decorative elements -->
                    <div
                        class="absolute hidden lg:block top-1/2 left-0 w-32 h-32 bg-blue-100 rounded-full -translate-x-1/2 -translate-y-1/2 filter blur-3xl opacity-30">
                    </div>
                    <div
                        class="absolute hidden lg:block bottom-0 right-0 w-48 h-48 bg-red-100 rounded-full translate-x-1/3 translate-y-1/3 filter blur-3xl opacity-30">
                    </div>

                    <!-- Feature 1 -->
                    <div
                        class="relative p-6 sm:p-8 lg:p-10 rounded-2xl bg-gradient-to-br from-white to-red-50 shadow-xl border border-red-100 hover:shadow-2xl hover:shadow-red-200/30 transition-all duration-500 transform hover:-translate-y-2 z-10">
                        <div
                            class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-red-600 to-red-400 rounded-2xl flex items-center justify-center mb-6 sm:mb-8 shadow-lg shadow-red-200/50">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl lg:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400 mb-4 sm:mb-5">
                            Fast Delivery</h3>
                        <p class="text-base text-gray-600 leading-relaxed mb-6 sm:mb-8">Quick and efficient logistics
                            solutions to meet your business needs with guaranteed timely delivery across Indonesia's
                            most challenging routes.</p>
                        <div
                            class="flex items-center text-red-600 font-medium cursor-pointer hover:text-red-700 transition-colors group">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="relative p-6 sm:p-8 lg:p-10 rounded-2xl bg-gradient-to-br from-white to-blue-50 shadow-xl border border-blue-100 hover:shadow-2xl hover:shadow-blue-200/30 transition-all duration-500 transform hover:-translate-y-2 z-10">
                        <div
                            class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center mb-6 sm:mb-8 shadow-lg shadow-blue-200/50">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl lg:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400 mb-4 sm:mb-5">
                            Safe & Secure</h3>
                        <p class="text-base text-gray-600 leading-relaxed mb-6 sm:mb-8">Your cargo's safety is our top
                            priority with comprehensive end-to-end security measures and real-time tracking throughout
                            the journey.</p>
                        <div
                            class="flex items-center text-blue-600 font-medium cursor-pointer hover:text-blue-700 transition-colors group">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="relative p-6 sm:p-8 lg:p-10 rounded-2xl bg-gradient-to-br from-white to-green-50 shadow-xl border border-green-100 hover:shadow-2xl hover:shadow-green-200/30 transition-all duration-500 transform hover:-translate-y-2 z-10">
                        <div
                            class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-600 to-green-400 rounded-2xl flex items-center justify-center mb-6 sm:mb-8 shadow-lg shadow-green-200/50">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl lg:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 mb-4 sm:mb-5">
                            Reliable Service</h3>
                        <p class="text-base text-gray-600 leading-relaxed mb-6 sm:mb-8">Consistent and dependable
                            logistics solutions you can count on, backed by years of experience and deep knowledge of
                            local markets.</p>
                        <div
                            class="flex items-center text-green-600 font-medium cursor-pointer hover:text-green-700 transition-colors group">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Testimonial with modern design -->
                <div class="mt-16 sm:mt-20 lg:mt-28">
                    <div
                        class="relative p-8 sm:p-10 lg:p-14 rounded-2xl bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-xl overflow-hidden">
                        <!-- Decorative elements -->
                        <div
                            class="absolute top-0 left-0 w-72 h-72 bg-blue-500 rounded-full opacity-20 -translate-x-1/2 -translate-y-1/2 blur-3xl">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-72 h-72 bg-blue-400 rounded-full opacity-20 translate-x-1/2 translate-y-1/2 blur-3xl">
                        </div>

                        <div class="relative z-10">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-6 shadow-lg transform hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-quote-right text-3xl text-blue-600"></i>
                                </div>

                                <div class="flex space-x-1 mb-4">
                                    {!! str_repeat(
                                        '<svg class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>',
                                        5,
                                    ) !!}
                                </div>

                                <p
                                    class="text-xl sm:text-2xl lg:text-3xl text-center font-medium mb-8 italic max-w-3xl mx-auto">
                                    "Almeta has transformed how we manage our supply chain. Their reliable service and
                                    professional team make shipping easy, even to remote islands across Indonesia."
                                </p>

                                <div
                                    class="flex items-center bg-white/20 backdrop-blur-md rounded-full p-1.5 pl-2 pr-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center text-white font-bold text-lg mr-3 shadow-md">
                                        P</div>
                                    <div>
                                        <div class="font-bold text-white text-base sm:text-lg">PT. Pacific Industries
                                        </div>
                                        <div class="text-sm text-blue-100">Jakarta, Indonesia</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9fafb" fill-opacity="1" d="M0,320L1440,192L1440,320L0,320Z"></path></svg>

        <!-- Footer with improved styling -->
        <footer class="bg-gray-50 text-black" id="contact">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo and Description -->
                <div class="flex flex-col items-center text-center mb-8 sm:mb-10 lg:mb-16">
                    <a href="#"
                        class="text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-500 mb-3 sm:mb-4 flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 mr-2" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 18L14 18" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M4 12L14 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M4 6L14 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M18 18L20 18" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M18 12L20 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M18 6L20 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                        </svg>
                        PT. Almeta Global Trilindo
                    </a>
                    <p class="max-w-md text-sm sm:text-base text-gray-600">Your trusted partner in domestic logistics
                        solutions since 2020,
                        providing fast, safe and reliable shipping services throughout Indonesia.</p>
                </div>

                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-5">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6 relative">
                            Contact Information
                            <span
                                class="absolute bottom-0 left-0 w-16 sm:w-20 h-1 bg-gradient-to-r from-red-600 to-red-400 rounded-full -mb-2"></span>
                        </h3>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="flex items-start">
                                <div
                                    class="mr-3 sm:mr-4 p-2 sm:p-3 bg-gradient-to-br from-red-100 to-red-50 rounded-lg shadow-sm">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm sm:text-base">Address</h4>
                                    <p class="text-xs sm:text-sm text-gray-600">Jasamarga Green Residence AD. 6 No. 7
                                        Sidoarjo, East Java
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="mr-3 sm:mr-4 p-2 sm:p-3 bg-gradient-to-br from-red-100 to-red-50 rounded-lg shadow-sm">
                                    <i class="fas fa-phone text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm sm:text-base">Phone</h4>
                                    <p class="text-xs sm:text-sm text-gray-600 hover:text-red-600 transition-colors">
                                        <a href="tel:+6281216996352" class="hover:underline">+62 812-1699-6352</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information -->
                    <div class="space-y-5">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6 relative">
                            Email Us
                            <span
                                class="absolute bottom-0 left-0 w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full -mb-2"></span>
                        </h3>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="flex items-start">
                                <div
                                    class="mr-3 sm:mr-4 p-2 sm:p-3 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg shadow-sm">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm sm:text-base">Company</h4>
                                    <p class="text-xs sm:text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                        <a href="mailto:almetagt@gmail.com"
                                            class="hover:underline">almetagt@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="mr-3 sm:mr-4 p-2 sm:p-3 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg shadow-sm">
                                    <i class="fas fa-headset text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm sm:text-base">Customer Service</h4>
                                    <p class="text-xs sm:text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                        <a href="mailto:aldivo.ishen@gmail.com"
                                            class="hover:underline">aldivo.ishen@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Subscription -->
                    <div class="space-y-4 sm:space-y-5">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6 relative">
                            Stay Updated
                            <span
                                class="absolute bottom-0 left-0 w-16 sm:w-20 h-1 bg-gradient-to-r from-green-600 to-green-400 rounded-full -mb-2"></span>
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">Subscribe to our newsletter for
                            updates on services, promotions
                            and shipping news.</p>
                        <form class="space-y-3">
                            <div class="relative">
                                <input type="email" placeholder="Your email address"
                                    class="w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                                <button type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-800 text-white p-1.5 sm:p-2 rounded-md transition-colors">
                                    <i class="fas fa-paper-plane text-xs sm:text-sm"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Social Media Links -->
                        <div class="mt-6 sm:mt-8">
                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-2 sm:mb-3">Follow us</p>
                            <div class="flex space-x-3 sm:space-x-4">
                                <a href="#"
                                    class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-gray-100 to-white flex items-center justify-center hover:from-blue-50 hover:to-blue-100 transition-all duration-300 shadow-sm hover:shadow-md group">
                                    <i
                                        class="fab fa-facebook-f text-blue-600 group-hover:scale-110 transition-transform duration-300"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-gray-100 to-white flex items-center justify-center hover:from-blue-50 hover:to-blue-100 transition-all duration-300 shadow-sm hover:shadow-md group">
                                    <i
                                        class="fab fa-twitter text-blue-400 group-hover:scale-110 transition-transform duration-300"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-gray-100 to-white flex items-center justify-center hover:from-red-50 hover:to-red-100 transition-all duration-300 shadow-sm hover:shadow-md group">
                                    <i
                                        class="fab fa-instagram text-red-500 group-hover:scale-110 transition-transform duration-300"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-gray-100 to-white flex items-center justify-center hover:from-blue-50 hover:to-blue-100 transition-all duration-300 shadow-sm hover:shadow-md group">
                                    <i
                                        class="fab fa-linkedin-in text-blue-700 group-hover:scale-110 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-8 sm:my-10">
                </div>

                <!-- Bottom Footer -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-xs sm:text-sm text-gray-500">&copy; {{ date('Y') }} PT. ALMETA GLOBAL
                            TRILINDO. All
                            rights reserved.
                        </p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 sm:gap-6 md:space-x-6 md:gap-0">
                        <a href="#"
                            class="text-xs sm:text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-xs sm:text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">Terms
                            of
                            Service</a>
                        <a href="#"
                            class="text-xs sm:text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">FAQ</a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile Menu Toggle Function
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        // Toggle menu visibility
                        if (mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.remove('hidden');
                        } else {
                            mobileMenu.classList.add('hidden');
                        }
                    });

                    // Close menu when clicking links
                    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
                    mobileMenuLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            mobileMenu.classList.add('hidden');
                        });
                    });

                    // Close menu when resizing to desktop
                    window.addEventListener('resize', function() {
                        if (window.innerWidth >= 768) { // md breakpoint in Tailwind
                            mobileMenu.classList.add('hidden');
                        }
                    });
                }

                // Form submission handling
                function handleFormSubmit(event) {
                    event.preventDefault();

                    const submitButton = document.getElementById('submitButton');
                    const buttonText = document.getElementById('buttonText');
                    const loadingSpinner = document.getElementById('loadingSpinner');

                    if (submitButton && buttonText && loadingSpinner) {
                        submitButton.disabled = true;
                        buttonText.classList.add('hidden');
                        loadingSpinner.classList.remove('hidden');

                        setTimeout(() => {
                            event.target.submit();
                        }, 300);
                    }
                }

                // Add form submit handler to any search forms
                const searchForm = document.querySelector('form[action="{{ route('landing-page') }}"]');
                if (searchForm) {
                    searchForm.addEventListener('submit', handleFormSubmit);
                }
            });

            // Form submission handling
            window.handleFormSubmit = function(event) {
                event.preventDefault();

                const submitButton = document.getElementById('submitButton');
                const buttonText = document.getElementById('buttonText');
                const loadingSpinner = document.getElementById('loadingSpinner');

                if (submitButton && buttonText && loadingSpinner) {
                    submitButton.disabled = true;
                    buttonText.classList.add('hidden');
                    loadingSpinner.classList.remove('hidden');

                    setTimeout(() => {
                        event.target.submit();
                    }, 300);
                }
            };

            // Add form submit handler to any search forms
            const searchForm = document.querySelector('form[action="{{ route('landing-page') }}"]');
            if (searchForm) {
                searchForm.addEventListener('submit', handleFormSubmit);
            }

            // Fix for smooth scrolling to anchors
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80, // Adjust for header height
                            behavior: 'smooth'
                        });
                    }
                });
            });
        </script>

        <!-- Additional styles for mobile responsiveness -->

        <style>
            /* Animation for mobile menu */
            @keyframes fadeIn {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.3s ease-out forwards;
            }

            /* Improved mobile menu positioning */
            #mobile-menu {
                transition: all 0.3s ease-in-out;
            }

            /* Fix for z-index hierarchy */
            .z-40 {
                z-index: 40;
            }

            /* Ensure menu button has proper hit area */
            #mobile-menu-button {
                min-height: 44px;
                min-width: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .animate-fade-in {
                animation: fadeIn 0.3s ease-out forwards;
            }

            /* Smooth scrolling for anchor links */
            html {
                scroll-behavior: smooth;
            }

            /* Fix for mobile overflow issues */
            body {
                overflow-x: hidden;
            }

            /* Responsive font sizes */
            @media (max-width: 640px) {
                .text-4xl {
                    font-size: 2rem;
                }

                .text-3xl {
                    font-size: 1.75rem;
                }

                .text-2xl {
                    font-size: 1.5rem;
                }

                .text-xl {
                    font-size: 1.25rem;
                }
            }
        </style>
    </div>
</x-guest-layout>
