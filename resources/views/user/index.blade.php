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
        <nav class="border-b border-gray-100 backdrop-blur-lg bg-white/80 fixed w-full top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-14 md:h-16">
                    <div class="flex items-center">
                        <a href="#"
                            class="text-lg md:text-xl font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent hover:scale-105 transition duration-300">
                            PT. Almeta Global Trilindo
                        </a>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('login') }}" wire:navigate
                            class="group inline-flex items-center px-4 sm:px-6 py-2 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:text-white transition-all duration-300 hover:bg-blue-600">
                            <span class="relative">Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden pt-14 md:pt-16">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-16 sm:py-24 lg:py-32">
                    <div class="text-center">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight mb-6 animate-fade-in">
                            <span
                                class="bg-gradient-to-r from-red-600 via-red-700 to-red-800 bg-clip-text text-transparent">
                                ALMETA
                            </span>
                        </h1>
                        <p
                            class="mt-6 max-w-3xl mx-auto text-xl sm:text-2xl text-gray-700 leading-relaxed font-light animate-fade-in-up">
                            Fast, Safe, and Reliable Domestic Logistics solutions for your business.
                        </p>
                        <p
                            class="mt-4 max-w-2xl mx-auto text-base sm:text-lg text-gray-500 leading-relaxed animate-fade-in-up delay-200">
                            In a fast-paced business world, small and medium industries (IKM) need fast, safe and
                            reliable logistics solutions.
                        </p>
                        <div
                            class="mt-8 sm:mt-10 flex flex-col sm:flex-row justify-center gap-4 px-4 animate-fade-in-up delay-300">
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-6 sm:px-8 py-3 text-base sm:text-lg font-semibold rounded-full text-white bg-gradient-to-r from-red-600 to-red-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                Search Route
                                <i class="fas fa-search ml-2"></i>
                            </a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-6 sm:px-8 py-3 text-base sm:text-lg font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                Get Started
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="relative z-10 py-12 sm:py-16 bg-white/50 backdrop-blur-sm" id="filtering">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">
                        Find your perfect route
                    </h2>
                    <p class="text-gray-600 text-base sm:text-lg">Search available shipments between ports</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('landing-page') }}" method="GET"
                    class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-8 mb-12 relative overflow-hidden"
                    onsubmit="handleFormSubmit(event)">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-red-50/50 opacity-50"></div>

                    <div class="relative">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-end">
                            <!-- POL Selection -->
                            <div class="lg:col-span-5">
                                <label for="pol" class="block mb-2 text-sm font-medium text-gray-700">Port of
                                    Loading (POL)</label>
                                <div class="relative">
                                    <select name="pol" id="pol"
                                        class="block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm">
                                        <option disabled selected>Select Port of Loading</option>
                                        @foreach ($fromCities as $city)
                                            <option value="{{ $city }}"
                                                {{ request('pol') == $city ? 'selected' : '' }}>
                                                {{ strtoupper($city) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-anchor text-base"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Direction Icon -->
                            <div class="hidden lg:flex lg:col-span-2 justify-center items-center pb-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-arrow-right text-blue-500"></i>
                                </div>
                            </div>

                            <!-- POD Selection -->
                            <div class="lg:col-span-5">
                                <label for="pod" class="block mb-2 text-sm font-medium text-gray-700">Port of
                                    Discharge (POD)</label>
                                <div class="relative">
                                    <select name="pod" id="pod"
                                        class="block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm">
                                        <option disabled selected>Select Port of Discharge</option>
                                        @foreach ($fromCities as $city)
                                            <option value="{{ $city }}"
                                                {{ request('pod') == $city ? 'selected' : '' }}>
                                                {{ strtoupper($city) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-anchor text-base"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="lg:col-span-12">
                                <button id="submitButton" type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center group text-base sm:text-lg">
                                    <span id="buttonText">Find Available Ships</span>
                                    <i
                                        class="fa-solid fa-ship ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
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
                    <div class="space-y-6 sm:space-y-8">
                        <div class="flex items-center justify-between mb-6 sm:mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Available Shipments</h2>
                            <div class="text-sm text-gray-500">
                                {{ $shipments->count() }} routes found
                            </div>
                        </div>

                        @if ($shipments->isEmpty())
                            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-8 sm:p-12 text-center">
                                <div class="text-gray-400 mb-4 sm:mb-6">
                                    <i class="fas fa-ship text-4xl sm:text-6xl"></i>
                                </div>
                                <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-2 sm:mb-3">No routes
                                    Available</h3>
                                <p class="text-gray-600">No shipments found for the selected route. Please try different
                                    ports.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-6 sm:gap-8">
                                @foreach ($shipments as $shipment)
                                    <div
                                        class="bg-white rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                                        <div class="p-4 sm:p-8">
                                            <!-- Shipment Card Header -->
                                            <div
                                                class="flex flex-col sm:flex-row justify-between items-start mb-4 sm:mb-6">
                                                <div>
                                                    <div class="flex flex-wrap items-center gap-2 sm:gap-4 mb-2">
                                                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900">
                                                            {{ $shipment->vessel_name }}
                                                        </h3>
                                                        <span
                                                            class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                                            Available
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center text-gray-600 text-sm sm:text-base">
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
                                                        <i
                                                            class="fa-solid fa-arrow-right text-gray-400 mx-2 sm:mx-3"></i>
                                                        <span
                                                            class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Timeline -->
                                            <div
                                                class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg sm:rounded-xl p-4 sm:p-6 mb-4 sm:mb-6">
                                                <div
                                                    class="grid grid-cols-1 sm:grid-cols-5 gap-4 sm:gap-6 items-center">
                                                    <div class="hidden sm:flex justify-center">
                                                        <div
                                                            class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-blue-200 flex items-center justify-center">
                                                            <i
                                                                class="fa-solid fa-ship text-blue-600 text-xl sm:text-2xl"></i>
                                                        </div>
                                                    </div>
                                                    @foreach (['etb', 'etd', 'eta'] as $timeKey)
                                                        <div class="space-y-1 sm:space-y-2 text-center">
                                                            <p class="text-xs sm:text-sm font-medium text-blue-600">
                                                                {{ strtoupper($timeKey) }}
                                                            </p>
                                                            <p class="font-bold text-gray-800 text-base sm:text-lg">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                            </p>
                                                            <p class="text-xs sm:text-sm text-gray-500">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                    <div class="hidden sm:flex justify-center">
                                                        <div
                                                            class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-blue-200 flex items-center justify-center">
                                                            <i
                                                                class="fa-solid fa-anchor text-blue-600 text-xl sm:text-2xl"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Price and Book Now Button -->
                                            <div
                                                class="flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-0 mt-4 sm:mt-6">
                                                <div class="text-center sm:text-left">
                                                    <p class="text-2xl sm:text-4xl font-bold text-gray-900">
                                                        Rp
                                                        {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                                    </p>
                                                    <p class="text-xs sm:text-sm text-gray-500 mt-1">/ Container</p>
                                                </div>
                                                <div class="hidden sm:block w-px h-16 bg-gray-200 mx-8"></div>
                                                <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}"
                                                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium text-base sm:text-lg rounded-lg sm:rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                                                    Book Now
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 sm:h-5 sm:w-5 ml-2" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
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
        <div class="relative z-10 py-16 sm:py-24 backdrop-blur-sm bg-gradient-to-b from-transparent to-white/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4">Why Choose Almeta?</h2>
                    <p class="text-base sm:text-lg text-gray-600">Experience the best in logistics services</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 lg:gap-12">
                    <!-- Feature 1 -->
                    <div
                        class="p-6 sm:p-8 rounded-xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Fast Delivery</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed">Quick and efficient logistics
                            solutions to meet your business needs with guaranteed timely delivery.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="p-6 sm:p-8 rounded-xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Safe & Secure</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed">Your cargo's safety is our top
                            priority with comprehensive end-to-end security measures.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="p-6 sm:p-8 rounded-xl sm:rounded-3xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Reliable Service</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed">Consistent and dependable
                            logistics solutions you can count on, backed by years of experience.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative z-10 bg-gray-900 text-white py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-4 sm:mb-6">Contact Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-red-500"></i>
                                <p class="text-sm sm:text-base">Jasamarga Green Residence AD. 6 No. 7 Sidoarjo, East
                                    Java</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-3 text-red-500"></i>
                                <p class="text-sm sm:text-base">+62 812-1699-6352</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-4 sm:mb-6">Email Us</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-red-500"></i>
                                <p class="text-sm sm:text-base">Company: almetagt@gmail.com</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-headset mr-3 text-red-500"></i>
                                <p class="text-sm sm:text-base">Customer Service: aldivo.ishen@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- About Us -->
                    <div class="space-y-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-4 sm:mb-6">About Us</h3>
                        <p class="text-sm sm:text-base text-gray-400">Your trusted partner in domestic logistics
                            solutions. We provide fast, safe, and reliable shipping services in Indonesia.</p>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-10 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-800 text-center">
                    <p class="text-sm sm:text-base text-gray-400">Powered by PT. ALMETA GLOBAL TRILINDO</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-2">&copy; 2024 All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Animations -->
        <style>
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
