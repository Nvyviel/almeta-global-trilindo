@extends('layouts.main')

@section('title', 'Approval Release Order')
@section('component')
    <div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6 bg-gray-50">
        <!-- Header with improved styling -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">Release Order Approval</h1>
            <a href="{{ route('history-ro') }}" wire:navigate
                class="flex items-center text-blue-700 hover:text-blue-900 bg-white px-4 py-2 rounded-lg shadow-sm transition duration-300 border border-blue-200 hover:border-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                View History
            </a>
        </div>

        <!-- Enhanced Search and Filter Section -->
        <div
            class="bg-white rounded-lg shadow-md overflow-hidden mb-6 border border-gray-100 hover:shadow-lg transition-all duration-300">
            <div class="bg-blue-700 p-4 border-b border-blue-800">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter Vessel
                </h2>
            </div>
            <div class="p-5">
                <form method="GET" action="{{ route('approval-ro') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Select Vessel with improved styling -->
                        <div>
                            <label for="selectedVessel" class="block text-sm font-medium text-gray-700 mb-1">Select
                                Vessel</label>
                            <div class="relative">
                                <select id="selectedVessel" name="selectedVessel"
                                    class="w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm transition duration-300 text-gray-700 appearance-none">
                                    <option value="">Choose a Vessel</option>
                                    @foreach ($availableVessel as $name)
                                        <option value="{{ $name }}"
                                            {{ request('selectedVessel') == $name ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Search Field -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="Search by commodity or company..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition duration-300">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Order ID Field -->
                        <div>
                            <label for="id_order" class="block text-sm font-medium text-gray-700 mb-1">Release Order
                                ID</label>
                            <div class="relative">
                                <input type="text" id="id_order" name="id_order" value="{{ request('id_order') }}"
                                    placeholder="Search by Release Order ID..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition duration-300">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7h3a5 5 0 010 10h-3m-6 0H6a5 5 0 110-10h3" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 pt-2">
                        <button type="submit"
                            class="sm:flex-1 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Data
                        </button>

                        <a href="{{ route('approval-ro') }}" wire:navigate
                            class="sm:flex-1 bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition duration-300 flex items-center justify-center shadow-sm border border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>

                @if (session('success'))
                    <div class="mt-4 p-3 bg-green-50 border-l-4 border-green-400 text-green-700 animate-fadeIn">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-3 text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Enhanced Container Cards -->
        <div class="space-y-5">
            @forelse ($name_ship->where('status', 'Requested') as $container)
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <!-- Card Header with improved styling -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4 text-white">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <h2 class="text-xl font-bold">{{ $container->user->company_name }}</h2>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-400"></span>
                                    {{ $container->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <!-- Details Grid with improved styling -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <!-- Field Commodity -->
                            <div
                                class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-md transition-all duration-300">
                                <span class="text-xs uppercase font-semibold text-blue-600 block mb-1">Commodity</span>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                                    </svg>
                                    <p class="text-gray-900 font-bold">{{ strtoupper($container->commodity) }}</p>
                                </div>
                            </div>

                            <!-- Field Quantity -->
                            <div
                                class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-md transition-all duration-300">
                                <span class="text-xs uppercase font-semibold text-blue-600 block mb-1">Quantity</span>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                    <p class="text-gray-900 font-bold">{{ $container->quantity }}</p>
                                </div>
                            </div>

                            <!-- Field Vessel -->
                            <div
                                class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-md transition-all duration-300">
                                <span class="text-xs uppercase font-semibold text-blue-600 block mb-1">Vessel</span>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-900 font-bold">{{ $container->shipment_container->vessel_name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Field Order ID -->
                            <div
                                class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-md transition-all duration-300">
                                <span class="text-xs uppercase font-semibold text-blue-600 block mb-1">Release Order
                                    ID</span>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    <p class="text-gray-900 font-bold">{{ $container->id_order }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- View Detail Link -->
                        <div class="flex justify-end mb-5">
                            <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'approval-ro']) }}"
                                wire:navigate
                                class="flex items-center px-4 py-2 text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors border border-blue-200">
                                <span class="mr-2">View Details</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="bg-gray-50 rounded-lg p-5 mb-5 border border-gray-200">
                            <div class="space-y-3">
                                <div x-data="{ fileChosen: false }" class="space-y-3">
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Upload Release Order Document
                                    </h3>
                                    <div class="mt-1 flex flex-col items-center space-y-2">
                                        <div class="w-full">
                                            <label
                                                class="flex flex-col items-center justify-center px-6 py-4 border-2 border-dashed border-blue-300 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors duration-200 @error('pdf_ro') border-red-500 @enderror">
                                                <input type="file" name="pdf_ro" id="pdf_ro" class="sr-only"
                                                    accept=".pdf" x-on:change="fileChosen = true" required>
                                                <svg class="w-10 h-10 text-blue-500 mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="text-gray-600 font-medium">Choose file or drag and drop</span>
                                                <p class="text-sm text-gray-500 mt-1">Only PDF files (max. 10MB)</p>
                                            </label>
                                        </div>
                                    </div>
                                    <div x-show="fileChosen"
                                        class="text-sm text-gray-600 bg-blue-50 p-2 rounded-md border border-blue-100"
                                        x-data="{ fileName: '' }" x-init="$watch('fileChosen', () => fileName = document.getElementById('pdf_ro').files[0]?.name || '')" style="display: none;">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            <span>File selected: <span class="font-medium"
                                                    x-text="fileName"></span></span>
                                        </div>
                                    </div>
                                    @error('pdf_ro')
                                        <p class="text-sm text-red-600 bg-red-50 p-2 rounded-md border border-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 inline mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Section -->
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <form action="{{ route('ro-approved', $container->id) }}" method="POST"
                                class="w-full sm:w-1/2" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="pdf_ro" id="approve_pdf_ro" class="hidden" accept=".pdf">
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve Request
                                </button>
                            </form>

                            <form action="{{ route('ro-canceled', $container->id) }}" method="POST"
                                class="w-full sm:w-1/2">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-md p-8 text-center border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-blue-300 mb-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">No Release Orders Found</h2>
                    <p class="text-gray-500 text-lg max-w-md mx-auto">There are currently no release orders available for
                        review.</p>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        document.getElementById('pdf_ro').addEventListener('change', function(e) {
            // Get the selected file
            const file = e.target.files[0];

            // Create a new FileList object
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set the file to the hidden input
            document.getElementById('approve_pdf_ro').files = dataTransfer.files;
        });
    </script>
@endsection
