<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Fullscreen Background Image -->
        <div class="w-1/2 bg-cover bg-center fixed top-0 bottom-0 left-0" 
             style="background-image: url('../assets/img/bg-login.jpg'); background-size: contain; background-repeat: no-repeat;">
        </div>
        
        <!-- Login Form Section -->
        <div class="w-1/2 overflow-y-auto ml-auto p-6 sm:p-12 flex items-center justify-center">
            <div class="w-full max-w-md">
                <form method="POST" action="{{ route('login') }}" class="bg-white bg-opacity-80 rounded-lg p-8">
                    @csrf
                    <h1 class="text-center text-3xl font-bold text-slate-900 mb-6">Login</h1>

                    {{-- General Error Handling --}}
                    @if($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Oops! Ada beberapa masalah dengan login Anda.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-4">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block font-medium text-gray-700">Email</label>
                            <input id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('email') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                                required 
                                placeholder="Enter your email">
                            @error('email')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block font-medium text-gray-700">Password</label>
                            <input id="password" 
                                type="password" 
                                name="password" 
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('password') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"  
                                required 
                                placeholder="Enter your password">
                            @error('password')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center mt-4">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('register') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-800">Don't have an account? Register</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">
                            Login
                        </button>
                    </div>

                    {{-- Forgot Password --}}
                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-blue-600 hover:text-blue-800">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>