<x-guest-layout>
    @section('title-guest', 'Almeta - Reliable Logistics')

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
    <!-- Background gradient wrapper -->
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-blue-50 relative">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-bl from-red-100/40 to-transparent rounded-full blur-3xl animate-pulse">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-gradient-to-tr from-blue-100/40 to-transparent rounded-full blur-3xl animate-pulse">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[1000px] h-[1000px] bg-gradient-to-r from-purple-100/20 via-transparent to-transparent rounded-full blur-3xl animate-pulse">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="border-b border-gray-100 backdrop-blur-md bg-white/90 fixed w-full top-0 z-50 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-3">
                    <div class="flex items-center space-x-2">
                        <a href="#"
                            class="text-lg font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent hover:scale-105 transition duration-200">
                            PT. Almeta Global Trilindo
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" wire:navigate
                            class="group relative inline-flex items-center px-8 py-3 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:text-white transition-all duration-300 ease-in-out hover:bg-blue-600 hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="relative">Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden pt-10">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-20 sm:py-32 lg:py-40">
                    <div class="text-center">
                        <h1 class="text-6xl sm:text-7xl lg:text-8xl font-extrabold tracking-tight mb-8">
                            <span class="bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent">
                                ALMETA
                            </span>
                        </h1>
                        <p class="mt-6 max-w-3xl mx-auto text-2xl sm:text-3xl text-gray-700 leading-relaxed font-light">
                            Fast, Safe, and Reliable Domestic Logistics solutions for your business.
                        </p>
                        <p class="mt-6 max-w-3xl mx-auto text-md sm:text-lg text-gray-500 leading-relaxed">
                            In a fast-paced business world, small and medium industries (IKM) need fast, safe and
                            reliable logistics solutions to ensure their goods reach their destination efficiently. This
                            website is presented as an end-to-end logistics platform specifically designed to meet
                            domestic shipping needs, both for SMEs, distributors and other business actors.
                        </p>
                        <div class="mt-12 flex flex-col sm:flex-row justify-center gap-6 px-4">
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold rounded-full text-white bg-red-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                Search Route
                        </a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold rounded-full text-white bg-blue-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="relative z-10 py-10" id="filtering">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 sm:text-4xl mb-2">
                        Find your perfect route
                    </h2>
                    <p class="text-gray-600">Search available shipments between ports</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('landing-page') }}" method="GET"
                    class="bg-white rounded-xl shadow-lg p-6 mb-12 relative overflow-hidden"
                    onsubmit="handleFormSubmit(event)">
                    <div class="absolute inset-0 bg-gradient-to-br from-transparent to-blue-50 opacity-50"></div>

                    <div class="relative">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end">
                            <!-- POL Selection -->
                            <div class="lg:col-span-5">
                                <label for="pol" class="block mb-2 text-sm font-medium text-gray-700">Port of
                                    Loading (POL)</label>
                                <div class="relative">
                                    <select name="pol" id="pol"
                                        class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
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
                                <label for="pod" class="block mb-2 text-sm font-medium text-gray-700">Port of
                                    Discharge (POD)</label>
                                <div class="relative">
                                    <select name="pod" id="pod"
                                        class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
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
                                        <i class="fas fa-anchor"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="lg:col-span-12">
                                <button id="submitButton" type="submit"
                                    class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium flex items-center justify-center group">
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
                    <div class="space-y-6">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-gray-900">Available Shipments</h2>
                            <div class="text-sm text-gray-500">
                                {{ $shipments->count() }} routes found
                            </div>
                        </div>

                        @if ($shipments->isEmpty())
                            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                                <div class="text-gray-400 mb-3">
                                    <i class="fas fa-ship text-5xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No routes Available</h3>
                                <p class="text-gray-600">No shipments found for the selected route. Please try different
                                    ports or dates.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-6">
                                @foreach ($shipments as $shipment)
                                    <div
                                        class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                                        <div class="p-6">
                                            <!-- Shipment Card Content -->
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <div class="flex items-center text-gray-600 mt-2">
                                                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                                                            {{ $shipment->vessel_name }}
                                                        </h3>
                                                        <span
                                                            class="font-medium text-sm ml-3">{{ strtoupper($shipment->from_city) }}</span>
                                                        <i
                                                            class="fa-solid fa-arrow-right-long text-xs text-gray-500 p-2"></i>
                                                        <span
                                                            class="font-medium text-sm">{{ strtoupper($shipment->to_city) }}</span>
                                                    </div>
                                                    <p class="text-xs text-gray-500">
                                                        Closing:
                                                        {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y - H:i') }}
                                                    </p>
                                                </div>
                                                <span
                                                    class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium">Available</span>
                                            </div>

                                            <!-- Timeline -->
                                            <div
                                                class="border-2 bg-blue-50 border-dashed border-blue-400 rounded-lg p-4 mb-4">
                                                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                                                    <div class="flex justify-center">
                                                        <i class="fa-solid fa-ship text-blue-600 text-4xl"></i>
                                                    </div>
                                                    @foreach (['etb', 'etd', 'eta'] as $timeKey)
                                                        <div class="space-y-1 text-center">
                                                            <p class="text-sm font-medium text-gray-500">
                                                                {{ strtoupper($timeKey) }}</p>
                                                            <p class="font-semibold text-gray-800">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                    <div class="flex justify-center">
                                                        <div
                                                            class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                                            <i class="fa-solid fa-anchor text-blue-600 text-xl"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Price and Book Now Button -->
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="flex-1">
                                                    <p class="text-3xl font-bold text-gray-900">
                                                        Rp
                                                        {{ number_format($shipment->rate_per_container, 0, ',', '.') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">/ Container</p>
                                                </div>
                                                <div class="w-px h-12 bg-gray-200 mx-6"></div>
                                                <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}"
                                                    class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-medium text-sm rounded-full hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                                    Book Now
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2"
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
        <div class="relative z-10 py-20 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div
                        class="p-8 rounded-3xl bg-white/80 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-red-100 to-red-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Fast Delivery</h3>
                        <p class="text-gray-600 text-lg">Quick and efficient logistics solutions to meet your business
                            needs.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="p-8 rounded-3xl bg-white/80 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Safe & Secure</h3>
                        <p class="text-gray-600 text-lg">Your cargo's safety is our top priority with end-to-end
                            security.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="p-8 rounded-3xl bg-white/80 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Reliable Service</h3>
                        <p class="text-gray-600 text-lg">Consistent and dependable logistics solutions you can count
                            on.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Contact Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/6281216996352" target="_blank"
            class="flex items-center px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12c0 2.19.7 4.22 1.88 5.88L2 22l4.12-1.88C7.78 21.3 9.81 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.89 0-3.68-.55-5.2-1.59l-.37-.25-2.44 1.12 1.12-2.44-.25-.37C4.55 15.68 4 13.89 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8-3.58 8-8 8zm4.14-6.35c-.23-.12-1.34-.66-1.55-.74-.21-.08-.36-.12-.51.12-.15.23-.58.74-.71.89-.13.15-.26.17-.49.06-.23-.12-.98-.36-1.86-1.1-.69-.57-1.16-1.28-1.29-1.5-.13-.23-.01-.36.1-.49.11-.11.23-.26.34-.38.11-.13.15-.23.23-.38.08-.15.04-.28-.02-.38-.06-.1-.51-1.22-.7-1.67-.18-.44-.37-.38-.51-.39-.13 0-.28-.01-.42-.01s-.39.06-.59.28c-.2.23-.78.76-.78 1.85s.8 2.14.91 2.29c.11.15 1.57 2.4 3.8 3.36.53.23.95.36 1.27.46.53.17 1.02.15 1.41.09.43-.07 1.34-.55 1.53-1.07.19-.52.19-.96.13-1.07-.06-.11-.23-.17-.49-.29z" />
            </svg>
        </a>
    </div>

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

        .animate-gradient {
            background-size: 200% auto;
            animation: gradient 4s ease infinite;
        }
    </style>
</x-guest-layout>
