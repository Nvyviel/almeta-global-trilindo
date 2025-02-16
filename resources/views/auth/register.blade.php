<x-guest-layout>
    @section('title-guest', 'Register')

    <!-- Full screen background container -->
    <div class="min-h-screen relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('../assets/img/bg-register.jpg');">

        <!-- Overlay for better readability -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Form Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl">
                <form method="POST" action="{{ route('register') }}"
                    class="backdrop-blur-sm bg-white/30 rounded-lg p-8 shadow-xl" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center text-3xl font-bold text-white mb-6">Register</h1>

                    {{-- General Error Handling --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100/90 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Sorry, you cannot register because:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Personal Information --}}
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Email --}}
                            <div>
                                <label for="email" class="block font-medium text-white">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('email') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="example@gmail.com">
                                @error('email')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Full Name --}}
                            <div>
                                <label for="name" class="block font-medium text-white">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('name') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="Full name">
                                @error('name')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password" class="block font-medium text-white">Password</label>
                                <input id="password" type="password" name="password"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('password') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="******">
                                @error('password')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="password_confirmation" class="block font-medium text-white">Confirm
                                    Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('password_confirmation') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="******">
                                @error('password_confirmation')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Business Information --}}
                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="company_name" class="block font-medium text-white">Company Name</label>
                                <input id="company_name" type="text" name="company_name"
                                    value="{{ old('company_name') }}"
                                    class="uppercase block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('company_name') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="CV. EXAMPLE / PT. EXAMPLE">
                                @error('company_name')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="company_phone_number" class="block font-medium text-white">Company Phone
                                    Number</label>
                                <input id="company_phone_number" type="number" name="company_phone_number"
                                    value="{{ old('company_phone_number') }}"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('company_phone_number') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="0812345678910">
                                @error('company_phone_number')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="company_location" class="block font-medium text-white">Company
                                    Location</label>
                                <input id="company_location" type="text" name="company_location"
                                    value="{{ old('company_location') }}"
                                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm bg-white/80 
                                           @error('company_location') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                    required placeholder="City">
                                @error('company_location')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="company_address" class="block font-medium text-white">Company
                                    Address</label>
                                <textarea id="company_address" name="company_address" placeholder="Example Street No. 99, Surabaya, East Java"
                                    class="w-full resize-none h-28 mt-1 p-2 block rounded-md border shadow-sm bg-white/80 
                                           @error('company_address') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none">{{ old('company_address') }}</textarea>
                                @error('company_address')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Document Upload --}}
                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white">Upload KTP:</label>
                                <input type="file" name="ktp" accept="image/*"
                                    class="block w-full mt-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                           file:bg-blue-600 file:text-white hover:file:bg-blue-500
                                           @error('ktp') border-red-500 @enderror">
                                @error('ktp')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Upload NPWP:</label>
                                <input type="file" name="npwp" accept="image/*"
                                    class="block w-full mt-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                           file:bg-blue-600 file:text-white hover:file:bg-blue-500
                                           @error('npwp') border-red-500 @enderror">
                                @error('npwp')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Upload NIB:</label>
                                <input type="file" name="nib" accept="image/*"
                                    class="block w-full mt-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                           file:bg-blue-600 file:text-white hover:file:bg-blue-500
                                           @error('nib') border-red-500 @enderror">
                                @error('nib')
                                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0">
                        <a href="{{ route('login') }}" wire:navigate
                            class="text-sm text-white hover:text-blue-200">Already registered? Login</a>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
