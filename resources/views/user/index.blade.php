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

    <div class="min-h-screen bg-white relative">
        <!-- Navigation -->
        <nav class="border-b border-gray-100 bg-white fixed w-full top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <div class="flex items-center">
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" wire:navigate
                            class="inline-flex items-center px-6 py-2.5 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fas fa-user mr-2"></i>
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="pt-20 md:pt-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-16 sm:py-24">
                    <div class="text-center">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight text-red-600">
                            ALMETA
                        </h1>
                        <div class="mt-8 max-w-3xl mx-auto">
                            <p class="text-xl sm:text-2xl text-gray-700 leading-relaxed font-light">
                                <span class="border-b-4 border-yellow-200 pb-1">Fast, Safe, and Reliable</span>
                                Domestic Logistics solutions for your business.
                            </p>
                            <p class="mt-4 max-w-2xl mx-auto text-base sm:text-lg text-gray-500 leading-relaxed">
                                In a fast-paced business world, small and medium industries (IKM) need fast, safe and
                                reliable logistics solutions.
                            </p>
                        </div>
                        <div class="mt-10 sm:mt-12 flex flex-col sm:flex-row justify-center gap-4 px-4">
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-8 py-3.5 text-lg font-semibold rounded-lg text-white bg-red-600 hover:bg-red-700 shadow-md transition-colors">
                                <span>Search Route</span>
                                <i class="fas fa-search ml-2"></i>
                            </a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-8 py-3.5 text-lg font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-md transition-colors">
                                <span>Get Started</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="py-16 sm:py-20 bg-white" id="filtering">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-14">
                    <span
                        class="inline-block px-4 py-1.5 bg-blue-100 text-blue-800 text-sm font-medium rounded-full mb-3">Search
                        Routes</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
                        Find Your Perfect Shipping Route
                    </h2>
                    <p class="text-gray-600 text-lg sm:text-xl max-w-2xl mx-auto">Select ports and discover available
                        shipments with competitive rates</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('landing-page') }}" method="GET"
                    class="bg-white rounded-2xl shadow-lg p-5 sm:p-10 mb-16 border border-gray-100"
                    onsubmit="handleFormSubmit(event)">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-8 items-end">
                        <!-- POL Selection -->
                        <div class="lg:col-span-5">
                            <label for="pol" class="block mb-2 text-sm font-bold text-gray-700">
                                <span class="flex items-center">
                                    <i class="fas fa-anchor text-blue-600 mr-2"></i>
                                    Port of Loading (POL)
                                </span>
                            </label>
                            <div class="relative">
                                <select name="pol" id="pol"
                                    class="block w-full pl-4 pr-12 py-4 border-2 border-gray-200 hover:border-blue-400 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors">
                                    <option disabled selected>Select Port of Loading</option>
                                    @foreach ($fromCities as $city)
                                        <option value="{{ $city }}"
                                            {{ request('pol') == $city ? 'selected' : '' }}>
                                            {{ strtoupper($city) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-base"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Direction Icon -->
                        <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center shadow-md">
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
                            <div class="relative">
                                <select name="pod" id="pod"
                                    class="block w-full pl-4 pr-12 py-4 border-2 border-gray-200 hover:border-red-400 rounded-xl focus:ring-4 focus:ring-red-100 focus:border-red-500 appearance-none bg-white shadow-sm transition-colors">
                                    <option disabled selected>Select Port of Discharge</option>
                                    @foreach ($fromCities as $city)
                                        <option value="{{ $city }}"
                                            {{ request('pod') == $city ? 'selected' : '' }}>
                                            {{ strtoupper($city) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-base"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="lg:col-span-12 pt-4">
                            <button id="submitButton" type="submit"
                                class="w-full bg-blue-600 text-white py-4 px-8 rounded-xl hover:bg-blue-700 transition-colors font-bold flex items-center justify-center text-lg shadow-md">
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
                    <div class="space-y-8 sm:space-y-10">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Available Shipments</h2>
                                <p class="text-gray-500 mt-1">From {{ strtoupper(request('pol')) }} to
                                    {{ strtoupper(request('pod')) }}</p>
                            </div>
                            <div class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium flex items-center">
                                <i class="fas fa-route mr-2"></i>
                                <span>{{ $shipments->count() }} routes found</span>
                            </div>
                        </div>

                        @if ($shipments->isEmpty())
                            <div class="bg-white rounded-xl shadow-md p-10 sm:p-16 text-center border border-gray-100">
                                <div
                                    class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-6">
                                    <i class="fas fa-ship text-5xl text-blue-300"></i>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">No Routes Available</h3>
                                <p class="text-gray-600 text-lg max-w-md mx-auto mb-6">We couldn't find any shipments
                                    for the selected route. Please try different ports or check back later.</p>
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded-lg transition-colors">
                                    <i class="fas fa-search mr-2"></i>
                                    Try Another Route
                                </a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-8">
                                @foreach ($shipments as $shipment)
                                    <div
                                        class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all">
                                        <!-- Shipment Card Header with ribbon -->
                                        <div class="relative bg-blue-600 text-white p-6">
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
                                                    <div class="flex items-center text-white text-lg">
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
                                                        <div class="flex items-center mx-3 space-x-1">
                                                            <span class="w-2 h-2 bg-white rounded-full"></span>
                                                            <span class="w-12 h-0.5 bg-white"></span>
                                                            <span class="w-2 h-2 bg-white rounded-full"></span>
                                                        </div>
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6 sm:p-8">
                                            <!-- Timeline -->
                                            <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                                                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                                    <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                                                    Voyage Schedule
                                                </h4>

                                                <div class="relative">
                                                    <div
                                                        class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-10 relative">
                                                        @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                            <div
                                                                class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 relative z-10">
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
                                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-blue-700 transition-colors shadow-md">
                                                    Book Now
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
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

        <!-- Features Section -->
        <div class="py-16 sm:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <div class="p-6 text-center bg-white rounded-xl shadow-sm">
                        <div class="text-4xl font-bold text-red-600 mb-2">10+</div>
                        <div class="text-gray-500">Major Ports</div>
                    </div>
                    <div class="p-6 text-center bg-white rounded-xl shadow-sm">
                        <div class="text-4xl font-bold text-blue-600 mb-2">98%</div>
                        <div class="text-gray-500">On-Time Delivery</div>
                    </div>
                    <div class="p-6 text-center bg-white rounded-xl shadow-sm">
                        <div class="text-4xl font-bold text-green-600 mb-2">4.9<span class="text-xl">/5</span></div>
                        <div class="text-gray-500">Client Rating</div>
                    </div>
                    <div class="p-6 text-center bg-white rounded-xl shadow-sm">
                        <div class="text-4xl font-bold text-yellow-600 mb-2">24/7</div>
                        <div class="text-gray-500">Support</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 lg:gap-14">
                    <!-- Feature 1 -->
                    <div class="p-6 sm:p-8 rounded-xl bg-white shadow-md">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-red-100 rounded-xl flex items-center justify-center mb-6 sm:mb-8">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Fast Delivery</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4">Quick and
                            efficient logistics solutions to meet your business needs with guaranteed timely
                            delivery.</p>
                        <div
                            class="flex items-center text-red-600 font-medium cursor-pointer hover:text-red-700 transition-colors">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 sm:p-8 rounded-xl bg-white shadow-md">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-xl flex items-center justify-center mb-6 sm:mb-8">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Safe & Secure</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4">Your cargo's
                            safety is our top priority with comprehensive end-to-end security measures.</p>
                        <div
                            class="flex items-center text-blue-600 font-medium cursor-pointer hover:text-blue-700 transition-colors">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 sm:p-8 rounded-xl bg-white shadow-md">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-green-100 rounded-xl flex items-center justify-center mb-6 sm:mb-8">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Reliable Service</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-4">Consistent and
                            dependable logistics solutions you can count on, backed by years of experience.</p>
                        <div
                            class="flex items-center text-green-600 font-medium cursor-pointer hover:text-green-700 transition-colors">
                            <span>Learn more</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="mt-16 sm:mt-20 bg-white p-6 sm:p-10 rounded-xl shadow-sm border border-gray-100">
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
                                class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg mr-3">
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
        <footer class="bg-gray-50 text-black py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo and Description -->
                <div class="flex flex-col items-center text-center mb-10 sm:mb-16">
                    <a href="#" class="text-2xl font-bold text-red-600 mb-4">
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
                            <div class="flex items-start">
                                <div class="mr-4 p-3 bg-red-50 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Address</h4>
                                    <p class="text-gray-600">Jasamarga Green Residence AD. 6 No. 7 Sidoarjo, East Java
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="mr-4 p-3 bg-red-50 rounded-lg">
                                    <i class="fas fa-phone text-red-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Phone</h4>
                                    <p class="text-gray-600 hover:text-red-600 transition-colors">
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
                            <div class="flex items-start">
                                <div class="mr-4 p-3 bg-blue-50 rounded-lg">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Company</h4>
                                    <p class="text-gray-600 hover:text-blue-600 transition-colors">
                                        <a href="mailto:almetagt@gmail.com">almetagt@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="mr-4 p-3 bg-blue-50 rounded-lg">
                                    <i class="fas fa-headset text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Customer Service</h4>
                                    <p class="text-gray-600 hover:text-blue-600 transition-colors">
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
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-md transition-colors">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Social Media Links -->
                        <div class="mt-6">
                            <p class="text-sm font-medium text-gray-700 mb-3">Follow us</p>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i class="fab fa-twitter text-blue-400"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-red-100 transition-colors">
                                    <i class="fab fa-instagram text-red-500"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i class="fab fa-linkedin-in text-blue-700"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-200 my-10"></div>

                <!-- Bottom Footer -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO. All rights reserved.
                        </p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-sm text-gray-500 hover:text-red-600 transition-colors">Privacy
                            Policy</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-red-600 transition-colors">Terms of
                            Service</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-red-600 transition-colors">FAQ</a>
                    </div>
                </div>
            </div>
        </footer>

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
