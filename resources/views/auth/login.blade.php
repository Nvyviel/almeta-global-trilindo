<x-guest-layout>
        <a href="{{ route('register') }}" class="block mb-6 text-sm text-gray-600 hover:text-gray-800">
            Didn't have an account? Register
        </a>
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror" 
                       :value="old('email')" 
                       required 
                       autofocus 
                       autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror" 
                       required 
                       autocomplete="current-password" />
            </div>

            <!-- Error Messages -->
            @error('auth')
                <div class="text-red-500 text-sm text-center mt-2">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
            </div>

            <!-- Forgot Password and Submit -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="bg-red-700 text-white p-2 rounded-md shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    Log in
                </button>
            </div>
        </form>
        {{-- Letakkan kode ini di layout utama (misalnya app.blade.php) --}}
        @if ($errors->any())
            <div class="fixed bottom-4 right-4">
                @foreach ($errors->all() as $error)
                    <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg mb-2">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Untuk success message tetap ada --}}
        @if (session()->has('message'))
            <div class="fixed bottom-4 right-4">
                <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                    {{ session('message') }}
                </div>
            </div>
        @endif
</x-guest-layout>
