<x-guest-layout>
    @section('title-guest', 'Register')

    <!-- Full screen background container -->
    <div class="min-h-screen relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('../assets/img/bg-register.jpg');">

        <!-- Overlay for better readability -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Form Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4 py-12">
            <div class="w-full max-w-2xl">
                {{-- <!-- Logo - Optional -->
                <div class="mb-6 text-center">
                    <img src="../assets/img/logo.png" alt="Logo" class="h-16 mx-auto">
                </div> --}}

                <form method="POST" action="{{ route('register') }}"
                    class="backdrop-blur-md bg-white/20 rounded-xl p-8 shadow-2xl border border-white/10"
                    enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center text-3xl font-bold text-white mb-8 tracking-wide">Create Account</h1>

                    {{-- General Error Handling --}}
                    @if ($errors->any())
                        <div
                            class="mb-6 bg-red-100/90 border border-red-400 text-red-700 px-4 py-3 rounded-lg animate-fade-in">
                            <strong class="font-bold">Please check the following errors:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Sections Tabs --}}
                    <div class="mb-6 border-b border-white/30">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            <li class="mr-2">
                                <a href="#personal"
                                    class="inline-block p-4 text-white border-b-2 border-blue-500 rounded-t-lg active"
                                    onclick="showSection('personal'); return false;">
                                    Personal Information
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#business"
                                    class="inline-block p-4 text-white/70 hover:text-white border-b-2 border-transparent rounded-t-lg"
                                    onclick="showSection('business'); return false;">
                                    Business Details
                                </a>
                            </li>
                            <li>
                                <a href="#documents"
                                    class="inline-block p-4 text-white/70 hover:text-white border-b-2 border-transparent rounded-t-lg"
                                    onclick="showSection('documents'); return false;">
                                    Documents
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Personal Information Section --}}
                    <div id="personal-section" class="section-content">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Email --}}
                                <div>
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
                                    @error('email')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Full Name --}}
                                <div>
                                    <label for="name" class="block font-medium text-white text-sm mb-2 ml-1">Full
                                        Name</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                                            class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                                @error('name') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="Full name">
                                    </div>
                                    @error('name')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div>
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
                                    @error('password')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div>
                                    <label for="password_confirmation"
                                        class="block font-medium text-white text-sm mb-2 ml-1">Confirm Password</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </span>
                                        <input id="password_confirmation" type="password"
                                            name="password_confirmation"
                                            class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                                @error('password_confirmation') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="••••••">
                                    </div>
                                    @error('password_confirmation')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="button"
                                    class="px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-lg
                                    hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                    transition-all duration-300"
                                    onclick="showSection('business')">
                                    Next: Business Details
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Business Information Section --}}
                    <div id="business-section" class="section-content hidden">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Company Name --}}
                                <div>
                                    <label for="company_name"
                                        class="block font-medium text-white text-sm mb-2 ml-1">Company Name</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </span>
                                        <input id="company_name" type="text" name="company_name"
                                            value="{{ old('company_name') }}"
                                            class="uppercase block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                                @error('company_name') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="CV. EXAMPLE / PT. EXAMPLE">
                                    </div>
                                    @error('company_name')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Company Phone Number --}}
                                <div>
                                    <label for="company_phone_number"
                                        class="block font-medium text-white text-sm mb-2 ml-1">Company Phone
                                        Number</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </span>
                                        <input id="company_phone_number" type="number" name="company_phone_number"
                                            value="{{ old('company_phone_number') }}"
                                            class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                                @error('company_phone_number') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="0812345678910">
                                    </div>
                                    @error('company_phone_number')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Company Location --}}
                                <div>
                                    <label for="company_location"
                                        class="block font-medium text-white text-sm mb-2 ml-1">Company Location</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        <input id="company_location" type="text" name="company_location"
                                            value="{{ old('company_location') }}"
                                            class="block w-full pl-10 h-12 p-2 border border-gray-300/30 rounded-lg shadow-sm bg-white/90 
                                                @error('company_location') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="City">
                                    </div>
                                    @error('company_location')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Company Address --}}
                                <div>
                                    <label for="company_address"
                                        class="block font-medium text-white text-sm mb-2 ml-1">Company Address</label>
                                    <div class="relative">
                                        <span class="absolute top-3 left-3 flex items-start text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </span>
                                        <textarea id="company_address" name="company_address"
                                            class="w-full resize-none pl-10 h-28 mt-1 p-2 block rounded-lg border border-gray-300/30 shadow-sm bg-white/90 
                                                @error('company_address') border-red-500 @enderror 
                                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                            required placeholder="Example Street No. 99, Surabaya, East Java">{{ old('company_address') }}</textarea>
                                    </div>
                                    @error('company_address')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-6">
                                <button type="button"
                                    class="px-6 py-3 bg-gray-600 text-white text-sm font-medium rounded-lg shadow-lg
                                    hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 
                                    transition-all duration-300"
                                    onclick="showSection('personal')">
                                    Back: Personal Info
                                </button>
                                <button type="button"
                                    class="px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-lg
                                    hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                    transition-all duration-300"
                                    onclick="showSection('documents')">
                                    Next: Documents
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Document Upload Section --}}
                    <div id="documents-section" class="section-content hidden">
                        <div class="space-y-6">
                            <div class="flex grid-cols-3 space-x-2">
                                <!-- KTP Upload -->
                                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                                    <label class="block text-sm font-medium text-white mb-3">Upload KTP:</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="ktp"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/30 border-dashed rounded-lg cursor-pointer hover:bg-white/10 transition-all duration-300">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-3 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-white"><span class="font-semibold">Click
                                                        to upload</span> or drag and drop</p>
                                                <p class="text-xs text-white/70">PNG, JPG, JPEG (MAX. 2MB)</p>
                                                <p id="ktp_name" class="text-sm text-white font-medium mt-2 hidden">
                                                </p>
                                            </div>
                                            <input id="ktp" type="file" name="ktp" accept="image/*"
                                                class="hidden" />
                                        </label>
                                    </div>
                                    @error('ktp')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NPWP Upload -->
                                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                                    <label class="block text-sm font-medium text-white mb-3">Upload NPWP:</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="npwp"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/30 border-dashed rounded-lg cursor-pointer hover:bg-white/10 transition-all duration-300">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-3 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-white"><span class="font-semibold">Click
                                                        to upload</span> or drag and drop</p>
                                                <p class="text-xs text-white/70">PNG, JPG, JPEG (MAX. 2MB)</p>
                                                <p id="npwp_name" class="text-sm text-white font-medium mt-2 hidden">
                                                </p>
                                            </div>
                                            <input id="npwp" type="file" name="npwp" accept="image/*"
                                                class="hidden" />
                                        </label>
                                    </div>
                                    @error('npwp')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIB Upload -->
                                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                                    <label class="block text-sm font-medium text-white mb-3">Upload NIB:</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="nib"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/30 border-dashed rounded-lg cursor-pointer hover:bg-white/10 transition-all duration-300">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-3 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-white"><span class="font-semibold">Click
                                                        to upload</span> or drag and drop</p>
                                                <p class="text-xs text-white/70">PNG, JPG, JPEG (MAX. 2MB)</p>
                                                <p id="nib_name" class="text-sm text-white font-medium mt-2 hidden">
                                                </p>
                                            </div>
                                            <input id="nib" type="file" name="nib" accept="image/*"
                                                class="hidden" />
                                        </label>
                                    </div>
                                    @error('nib')
                                        <p class="text-red-300 text-sm mt-2 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-6">
                                <button type="button"
                                    class="px-6 py-3 bg-gray-600 text-white text-sm font-medium rounded-lg shadow-lg
                                    hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 
                                    transition-all duration-300"
                                    onclick="showSection('business')">
                                    Back: Business Details
                                </button>
                                <button type="submit"
                                    class="px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-lg shadow-lg
                                    hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 
                                    transition-all duration-300 transform hover:-translate-y-0.5">
                                    Complete Registration
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Login Link --}}
                    <div class="mt-8 text-center">
                        <a href="{{ route('login') }}" wire:navigate
                            class="text-sm text-white hover:text-blue-300 transition-colors duration-200">
                            Already have an account? <span class="font-semibold">Login</span>
                        </a>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center text-xs text-white/60">
                    &copy; {{ date('Y') }} Your Company. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Multi-step Form -->
    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });

            // Show the selected section
            document.getElementById(sectionId + '-section').classList.remove('hidden');

            // Update active tab
            document.querySelectorAll('a[href^="#"]').forEach(tab => {
                if (tab.getAttribute('href') === '#' + sectionId) {
                    tab.classList.add('border-blue-500', 'text-white');
                    tab.classList.remove('border-transparent', 'text-white/70');
                } else {
                    tab.classList.remove('border-blue-500', 'text-white');
                    tab.classList.add('border-transparent', 'text-white/70');
                }
            });
        }

        function displayFileName(inputId) {
            const input = document.getElementById(inputId);
            const fileNameDisplay = document.getElementById(inputId + '_name');

            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileNameDisplay.textContent = this.files[0].name;
                    fileNameDisplay.classList.remove('hidden');
                } else {
                    fileNameDisplay.textContent = '';
                    fileNameDisplay.classList.add('hidden');
                }
            });
        }

        // Initialize file name display for all document inputs
        document.addEventListener('DOMContentLoaded', function() {
            displayFileName('ktp');
            displayFileName('npwp');
            displayFileName('nib');
        });
    </script>

    <!-- Animations -->
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

        /* Smooth transitions */
        .section-content {
            transition: all 0.3s ease-in-out;
        }

        /* File upload hover effect */
        input[type="file"]::file-selector-button {
            transition: all 0.3s ease-in-out;
        }
    </style>
</x-guest-layout>
