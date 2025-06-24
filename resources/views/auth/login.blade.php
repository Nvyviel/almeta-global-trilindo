<x-guest-layout>
    @section('title-guest', 'Login')

    {{-- Notification Section --}}
    @if ($errors->any())
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div
                class="mx-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-700 hover:text-red-900 focus:outline-none">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div
                class="mx-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="mt-2 list-disc list-inside">
                            {{ session('success') }}
                        </span>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-green-700 hover:text-green-900 focus:outline-none">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-b from-blue-500/10 to-purple-500/5 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-t from-blue-500/5 to-transparent -z-10"></div>
        <div class="absolute top-20 left-20 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl -z-10"></div>

        <!-- Grid pattern background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.015] -z-10"></div>

        <!-- Content Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-6xl grid md:grid-cols-5 bg-white rounded-lg shadow-xl overflow-hidden">

                <!-- Left Column - Decorative Side with Background Image -->
                <div class="md:col-span-2 bg-cover bg-center bg-blue-600 bg-no-repeat p-8 relative hidden md:block overflow-hidden"
                    style="background-image: url('{{ asset('assets/img/Almeta-ship.png') }}');">

                    <!-- Dark overlay for better text readability -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- Content -->
                    <div class="relative h-full flex flex-col justify-between text-white z-10">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">ALMETA GLOBAL</h2>
                            <div class="w-12 h-1 bg-white/50 mb-6"></div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-3xl font-bold leading-tight">Seamless Shipping Solutions For Your Business
                            </h3>
                            <p class="text-white/90">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                                venenatis felis ac magna porttitor, nec placerat nisi dignissim.</p>

                            <!-- Testimonial -->
                            <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm mt-8">
                                <p class="italic text-white/80 text-sm mb-3">"Vestibulum ante ipsum primis in faucibus
                                    orci luctus et ultrices posuere cubilia curae; Mauris at ex vel justo."</p>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">PT</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Pacific Trading</p>
                                        <p class="text-xs text-white/70">Client since 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-sm text-white/50">
                            &copy; {{ date('Y') }} Almeta Global Trilindo
                        </div>
                    </div>
                </div>

                <!-- Right Column - Form Side -->
                <div class="md:col-span-3 p-8 md:p-12 flex flex-col justify-center">
                    <div class="max-w-md w-full mx-auto">
                        <div class="text-center mb-8">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Welcome Back</h1>
                            <p class="text-gray-600 mt-2">Please sign in to access your account</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            {{-- Email --}}
                            <div class="group">
                                <label for="email" class="block font-medium text-gray-700 text-sm mb-2 ml-1">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm 
                                            @error('email') border-red-500 @enderror 
                                            focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                        required placeholder="example@gmail.com">
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="group">
                                <label for="password"
                                    class="block font-medium text-gray-700 text-sm mb-2 ml-1">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                    <input id="password" type="password" name="password"
                                        class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                            @error('password') border-red-500 @enderror 
                                            focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                        required placeholder="••••••">
                                </div>
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                    class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm 
                                        focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                        hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                        transition-all duration-300 transform hover:-translate-y-0.5">
                                    Sign In
                                </button>
                            </div>

                            {{-- Links --}}
                            <div
                                class="flex flex-col sm:flex-row items-center justify-between pt-2 space-y-3 sm:space-y-0">
                                <a href="{{ route('register') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    Don't have an account? <span class="font-semibold">Register</span>
                                </a>
                                <a href="{{ route('password.request') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    Forgot your password?
                                </a>
                            </div>
                        </form>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-10">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced animations -->
    <style>
        /* Background grid pattern */
        .bg-grid-pattern {
            background-size: 20px 20px;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Improved focus styles */
        input:focus,
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
    </style>
</x-guest-layout>
