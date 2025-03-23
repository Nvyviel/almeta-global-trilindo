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

    <!-- Full screen background container -->
    <div class="min-h-screen relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('../assets/img/bg-login.jpg');">

        <!-- Overlay for better readability -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Content Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-md">
                <!-- Logo - Optional -->
                {{-- <div class="mb-6 text-center">
                    <img src="../assets/img/logo.png" alt="Logo" class="h-16 mx-auto">
                </div> --}}

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}"
                    class="backdrop-blur-md bg-white/20 rounded-xl p-8 shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-blue-700/10">
                    @csrf
                    <h1 class="text-center text-3xl font-bold text-white mb-8 tracking-wide">Welcome Back</h1>

                    <div class="space-y-6">
                        {{-- Email --}}
                        <div class="group">
                            <label for="email" class="block font-medium text-white text-sm mb-2 ml-1">Email
                                Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                        @error('email') border-red-500 @enderror 
                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                    required placeholder="example@gmail.com">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="group">
                            <label for="password"
                                class="block font-medium text-white text-sm mb-2 ml-1">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input id="password" type="password" name="password"
                                    class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90
                                        @error('password') border-red-500 @enderror 
                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                    required placeholder="••••••">
                            </div>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center mt-6">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm 
                                focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <label for="remember" class="ml-2 text-sm text-white">Remember me</label>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-lg
                                hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                transition-all duration-300 transform hover:-translate-y-0.5">
                            Sign In
                        </button>
                    </div>

                    {{-- Links --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-3 sm:space-y-0">
                        <a href="{{ route('register') }}" wire:navigate
                            class="text-sm text-white hover:text-blue-300 transition-colors duration-200">
                            Don't have an account? <span class="font-semibold">Register</span>
                        </a>
                        <a href="{{ route('password.request') }}" wire:navigate
                            class="text-sm text-white hover:text-blue-300 transition-colors duration-200">
                            Forgot your password?
                        </a>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center text-xs text-white/60">
                    &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Add some basic animations -->
    <style>
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
    </style>
</x-guest-layout>
