<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Fullscreen Background Image -->
        <div class="w-1/2 bg-cover bg-center fixed top-0 bottom-0 left-0" 
             style="background-image: url('../assets/img/bg-register.jpg'); background-size: contain; background-repeat: no-repeat;">
        </div>
        
        <!-- Registration Form Section -->
        <div class="w-1/2 overflow-y-auto ml-auto p-6 sm:p-12 flex items-center justify-center">
            <div class="w-full max-w-md">
                <form method="POST" action="{{ route('register') }}" class="bg-white bg-opacity-80 rounded-lg p-8" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center text-3xl font-bold text-slate-900 mb-6">Register</h1>

                    {{-- General Error Handling --}}
                    @if($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Oops! Ada beberapa masalah dengan pendaftaran Anda.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Personal Information --}}
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

                        {{-- Full Name --}}
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Full Name</label>
                            <input id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('name') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                                required 
                                placeholder="Enter your full name">
                            @error('name')
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

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
                            <input id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('password_confirmation') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                                required 
                                placeholder="Confirm your password">
                            @error('password_confirmation')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Business Information --}}
                    <div class="mt-6 space-y-4">
                        <div>
                            <label for="company_name" class="block font-medium text-gray-700">Company Name</label>
                            <input id="company_name" 
                                type="text" 
                                name="company_name" 
                                value="{{ old('company_name') }}"
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('company_name') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                                required 
                                placeholder="Enter your company name">
                            @error('company_name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_phone_number" class="block font-medium text-gray-700">Company Phone Number</label>
                            <input id="company_phone_number" 
                                type="number" 
                                name="company_phone_number" 
                                value="{{ old('company_phone_number') }}"
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('company_phone_number') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                required 
                                placeholder="Enter your company phone number">
                            @error('company_phone_number')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_location" class="block font-medium text-gray-700">Company Location</label>
                            <input id="company_location" 
                                type="text" 
                                name="company_location" 
                                value="{{ old('company_location') }}"
                                class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm @error('company_location') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                                required 
                                placeholder="Enter your company location">
                            @error('company_location')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_address" class="block font-medium text-gray-700">Company Address</label>
                            <textarea id="company_address" 
                                    name="company_address"
                                    placeholder="Enter your company address" 
                                    class="w-full resize-none h-28 mt-1 p-2 block rounded-md border shadow-sm @error('company_address') border-red-500 @enderror focus:border-blue-400 focus:ring-blue-300 focus:outline-none"></textarea>
                            @error('company_address')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Document Upload --}}
                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Upload KTP:</label>
                            <input type="file" 
                                name="ktp" 
                                accept="image/*" 
                                class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200
                                @error('ktp') border-red-500 @enderror">
                            @error('ktp')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Upload NPWP:</label>
                            <input type="file" 
                                name="npwp" 
                                accept="image/*" 
                                class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200
                                @error('npwp') border-red-500 @enderror">
                            @error('npwp')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Upload NIB:</label>
                            <input type="file" 
                                name="nib" 
                                accept="image/*" 
                                class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200
                                @error('nib') border-red-500 @enderror">
                            @error('nib')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('login') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-800">Already registered? Login</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>