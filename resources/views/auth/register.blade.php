<x-guest-layout>
    @section('title-guest', 'Register')

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
                            <h3 class="text-3xl font-bold leading-tight">Join Our Network of Trusted Partners</h3>
                            <p class="text-white/90">Create your account today and gain access to our comprehensive
                                logistics platform. Streamline your shipping operations with Almeta.</p>

                            <!-- Testimonial -->
                            <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm mt-8">
                                <p class="italic text-white/80 text-sm mb-3">"Since partnering with Almeta, our shipping
                                    process has become significantly more efficient, reliable and cost-effective."</p>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">CT</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Cargo Trust</p>
                                        <p class="text-xs text-white/70">Client since 2021</p>
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
                <div class="md:col-span-3 p-6 md:p-10 flex flex-col justify-center">
                    <div class="w-full mx-auto">
                        <div class="text-center mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Create Account</h1>
                            <p class="text-gray-600 mt-2">Register to access our shipping services</p>
                        </div>

                        <!-- Improved Sections Tabs -->
                        <div class="mb-6 border-b border-gray-200">
                            <ul class="flex space-x-1 text-sm md:text-base font-medium text-center overflow-hidden">
                                <li class="flex-1">
                                    <a href="#personal"
                                        class="inline-block w-full py-3 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active transition-colors"
                                        onclick="showSection('personal'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Personal
                                        </div>
                                    </a>
                                </li>
                                <li class="flex-1">
                                    <a href="#business"
                                        class="inline-block w-full py-3 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 rounded-t-lg transition-colors"
                                        onclick="showSection('business'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            Business
                                        </div>
                                    </a>
                                </li>
                                <li class="flex-1">
                                    <a href="#documents"
                                        class="inline-block w-full py-3 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 rounded-t-lg transition-colors"
                                        onclick="showSection('documents'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Documents
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Personal Information Section --}}
                            <div id="personal-section" class="section-content">
                                <div class="space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        {{-- Email --}}
                                        <div class="group">
                                            <label for="email"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Email Address
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </span>
                                                <input id="email" type="email" name="email"
                                                    value="{{ old('email') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('email') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="example@gmail.com">
                                            </div>
                                            @error('email')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Full Name --}}
                                        <div class="group">
                                            <label for="name"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Full Name
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </span>
                                                <input id="name" type="text" name="name"
                                                    value="{{ old('name') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('name') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="Full name">
                                            </div>
                                            @error('name')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="group">
                                            <label for="password"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Password
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </span>
                                                <input id="password" type="password" name="password"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('password') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="••••••">
                                            </div>
                                            @error('password')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="group">
                                            <label for="password_confirmation"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Confirm Password
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </span>
                                                <input id="password_confirmation" type="password"
                                                    name="password_confirmation"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('password_confirmation') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="••••••">
                                            </div>
                                            @error('password_confirmation')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-end mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('business')">
                                            <span>Next: Business Details</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Business Information Section --}}
                            <div id="business-section" class="section-content hidden">
                                <div class="space-y-5">
                                    {{-- Company Name --}}
                                    <div class="group">
                                        <label for="company_name"
                                            class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                            Company Name
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </span>
                                            <input id="company_name" type="text" name="company_name"
                                                value="{{ old('company_name') }}"
                                                class="uppercase block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_name') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                required placeholder="CV. EXAMPLE / PT. EXAMPLE">
                                        </div>
                                        @error('company_name')
                                            <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                        {{-- Company Phone Number --}}
                                        <div class="group">
                                            <label for="company_phone_number"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Phone Number
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                    </svg>
                                                </span>
                                                <input id="company_phone_number" type="number"
                                                    name="company_phone_number"
                                                    value="{{ old('company_phone_number') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_phone_number') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="0812345678910">
                                            </div>
                                            @error('company_phone_number')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Company Location --}}
                                        <div class="group">
                                            <label for="company_location"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Location
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </span>
                                                <input id="company_location" type="text" name="company_location"
                                                    value="{{ old('company_location') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_location') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="City">
                                            </div>
                                            @error('company_location')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Company Address --}}
                                        <div class="group md:col-span-2">
                                            <label for="company_address"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Address
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute top-3 left-3 flex items-start text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>
                                                </span>
                                                <textarea id="company_address" name="company_address"
                                                    class="w-full resize-none pl-10 h-24 mt-1 p-2 block rounded-lg border border-gray-300 shadow-sm
                                                        @error('company_address') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="Example Street No. 99, Surabaya, East Java">{{ old('company_address') }}</textarea>
                                            </div>
                                            @error('company_address')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow-md
                                            hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('personal')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                            <span>Back: Personal Info</span>
                                        </button>
                                        <button type="button"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('documents')">
                                            <span>Next: Documents</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Document Upload Section --}}
                            <div id="documents-section" class="section-content hidden">
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                        <!-- KTP Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                                Upload KTP
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="ktp"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="ktp" type="file" name="ktp"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>
                                            @error('ktp')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NPWP Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                Upload NPWP
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="npwp"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="npwp" type="file" name="npwp"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>
                                            @error('npwp')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NIB Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                                </svg>
                                                Upload NIB
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="nib"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="nib" type="file" name="nib"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>
                                            @error('nib')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow-md
                                            hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('business')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                            <span>Back: Business Info</span>
                                        </button>
                                        <button type="submit"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center">
                                            <span>Create Account</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Login Link --}}
                        <div class="mt-6 text-center">
                            <a href="{{ route('login') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                                Already have an account? <span class="font-semibold ml-1">Login</span>
                            </a>
                        </div>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-10">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Multi-step Form with Enhanced File Upload Indicators -->
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
                    tab.classList.add('text-blue-600', 'border-blue-600');
                    tab.classList.remove('text-gray-500', 'border-transparent', 'hover:text-gray-700',
                        'hover:border-gray-300');
                } else {
                    tab.classList.remove('text-blue-600', 'border-blue-600');
                    tab.classList.add('text-gray-500', 'border-transparent', 'hover:text-gray-700',
                        'hover:border-gray-300');
                }
            });
        }

        // Simple file upload feedback script
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = ['ktp', 'npwp', 'nib'];

            fileInputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                if (input) {
                    input.addEventListener('change', function() {
                        const label = this.parentElement;
                        const fileName = this.files[0]?.name;

                        if (fileName) {
                            // Add file name display if needed
                            const fileNameElement = document.createElement('p');
                            fileNameElement.classList.add('text-xs', 'text-blue-600', 'mt-1',
                                'max-w-full', 'overflow-hidden', 'text-center');
                            fileNameElement.textContent = fileName;

                            // Remove any existing file name elements
                            const existingFileName = label.querySelector('.file-name');
                            if (existingFileName) {
                                existingFileName.remove();
                            }

                            // Add new file name
                            fileNameElement.classList.add('file-name');
                            label.appendChild(fileNameElement);

                            // Change background to indicate file selected
                            label.classList.add('bg-blue-50', 'border-blue-300');
                            label.classList.remove('bg-gray-50', 'hover:bg-gray-100');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Background grid pattern and animations -->
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

        /* Remove number input arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</x-guest-layout>
