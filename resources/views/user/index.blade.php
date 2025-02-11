<x-guest-layout>
    @section('title-guest', 'Almeta - Reliable Logistics')
    
    <!-- Background gradient wrapper -->
    <div class="min-h-screen bg-gradient-to-b to-white">
        <!-- Navigation -->
        <nav class="border-b border-gray-100 backdrop-blur-sm bg-white/80 fixed w-full top-0 z-50 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-3">
                    <div class="flex items-center space-x-2">
                        <a href="#" class="text-xl font-bold bg-clip-text text-red-700">
                            PT. Almeta Global Trilindo
                        </>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" wire:navigate
                            class="group relative inline-flex items-center px-6 py-2.5 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:text-white transition-all duration-200 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="relative">Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden pt-20">
            <!-- Decorative background elements -->
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 right-0 bg-gradient-to-bl from-red-100 to-transparent w-96 h-96 rounded-full blur-3xl opacity-30 -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 bg-gradient-to-tr from-blue-100 to-transparent w-96 h-96 rounded-full blur-3xl opacity-30 translate-y-1/2 -translate-x-1/2"></div>
            </div>

            <!-- Main content -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-20 sm:py-32 lg:py-40">
                    <div class="text-center">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight">
                            <span class="block text-red-700">
                                ALMETA
                            </span>
                        </h1>
                        <p class="mt-6 max-w-3xl mx-auto text-xl sm:text-2xl text-gray-600 leading-relaxed">
                            Fast, Safe, and Reliable Domestic Logistics Solutions for Your Business.
                        </p>
                        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4 px-4">
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-8 py-4 border-2 border-blue-600 text-base font-semibold rounded-full text-white bg-blue-600 hover:bg-blue-700 hover:border-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="relative z-10 py-16 bg-white/80 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-6 rounded-2xl bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                        <p class="text-gray-600">Quick and efficient logistics solutions to meet your business needs.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 rounded-2xl bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Safe & Secure</h3>
                        <p class="text-gray-600">Your cargo's safety is our top priority with end-to-end security.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 rounded-2xl bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Reliable Service</h3>
                        <p class="text-gray-600">Consistent and dependable logistics solutions you can count on.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Contact Button -->
    <div class="fixed bottom-5 right-5 z-50">
        <a href="https://wa.me/6281216996352" target="_blank" 
            class="flex items-center px-6 py-3 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12c0 2.19.7 4.22 1.88 5.88L2 22l4.12-1.88C7.78 21.3 9.81 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.89 0-3.68-.55-5.2-1.59l-.37-.25-2.44 1.12 1.12-2.44-.25-.37C4.55 15.68 4 13.89 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8-3.58 8-8 8zm4.14-6.35c-.23-.12-1.34-.66-1.55-.74-.21-.08-.36-.12-.51.12-.15.23-.58.74-.71.89-.13.15-.26.17-.49.06-.23-.12-.98-.36-1.86-1.1-.69-.57-1.16-1.28-1.29-1.5-.13-.23-.01-.36.1-.49.11-.11.23-.26.34-.38.11-.13.15-.23.23-.38.08-.15.04-.28-.02-.38-.06-.1-.51-1.22-.7-1.67-.18-.44-.37-.38-.51-.39-.13 0-.28-.01-.42-.01s-.39.06-.59.28c-.2.23-.78.76-.78 1.85s.8 2.14.91 2.29c.11.15 1.57 2.4 3.8 3.36.53.23.95.36 1.27.46.53.17 1.02.15 1.41.09.43-.07 1.34-.55 1.53-1.07.19-.52.19-.96.13-1.07-.06-.11-.23-.17-.49-.29z"/>
            </svg>
            Customer Service
        </a>
    </div>
</x-guest-layout>