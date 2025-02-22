@extends('layouts.main')

@section('title', 'Approval Release Order')
@section('component')
    <div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6">
        <!-- Back Button and History Button -->
        <div class="flex justify-between items-center mb-4 sm:mb-6">
            <a href="{{ route('history-ro') }}" wire:navigate
                class="flex items-center text-gray-600 hover:text-gray-800 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                History
            </a>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
            <div class="bg-gray-50 p-3 sm:p-4 border-b border-gray-200">
                <h2 class="text-base sm:text-lg font-semibold text-gray-800">Filter Vessel</h2>
            </div>
            <div class="p-3 sm:p-4">
                <form method="GET" action="{{ route('approval-ro') }}" class="space-y-3 sm:space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
                        <!-- Input untuk Select Vessel -->
                        <div>
                            <label for="selectedVessel" class="block text-sm font-medium text-gray-600 mb-1">Select
                                Vessel</label>
                            <select id="selectedVessel" name="selectedVessel"
                                class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                                <option value="">Choose a Vessel</option>
                                @foreach ($availableVessel as $name)
                                    <option value="{{ $name }}"
                                        {{ request('selectedVessel') == $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input untuk Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-600 mb-1">Search</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Search by commodity or company..."
                                class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>

                        <!-- Input untuk Order ID -->
                        <div>
                            <label for="id_order" class="block text-sm font-medium text-gray-600 mb-1">Release Order ID</label>
                            <input type="text" id="id_order" name="id_order" value="{{ request('id_order') }}"
                                placeholder="Search by Release Order ID..."
                                class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <button type="submit"
                            class="w-full sm:flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Data
                        </button>

                        <a href="{{ route('approval-ro') }}" wire:navigate
                            class="w-full sm:flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>

                @if (session('success'))
                    <div class="mt-4 p-3 sm:p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                        <div class="flex">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-3 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Container Cards -->
        <div class="space-y-4">
            @forelse ($name_ship->where('status', 'Requested') as $container)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                            <div class="space-y-2 mb-2 sm:mb-0">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h2 class="text-lg sm:text-xl font-semibold text-gray-900">
                                        {{ $container->user->company_name }}</h2>
                                </div>
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-400"></span>
                                    {{ $container->status }}
                                </span>
                            </div>
                            <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'approval-ro']) }}"
                                wire:navigate class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                            <!-- Field Commodity -->
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Commodity</span>
                                <p class="text-gray-900 font-semibold">{{ strtoupper($container->commodity) }}</p>
                            </div>

                            <!-- Field Quantity -->
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Quantity</span>
                                <p class="text-gray-900 font-semibold">{{ $container->quantity }}</p>
                            </div>

                            <!-- Field Vessel -->
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Vessel</span>
                                <p class="text-gray-900 font-semibold">{{ $container->shipment_container->vessel_name }}
                                </p>
                            </div>

                            <!-- Field Order ID -->
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Release Order ID</span>
                                <p class="text-gray-900 font-semibold">{{ $container->id_order }}</p>
                            </div>
                        </div>

                        <div class="p-4 sm:p-8">
                            <div class="space-y-2">
                                <div x-data="{ fileChosen: false }" class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Upload Release Order Document
                                    </label>
                                    <div
                                        class="mt-1 flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                        <div class="w-full sm:flex-1">
                                            <label
                                                class="flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200 @error('pdf_ro') border-red-500 @enderror">
                                                <input type="file" name="pdf_ro" id="pdf_ro" class="sr-only"
                                                    accept=".pdf" x-on:change="fileChosen = true" required>
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="text-sm text-gray-600">Choose file or drag and drop</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div x-show="fileChosen" class="text-sm text-gray-500" x-data="{ fileName: '' }"
                                        x-init="$watch('fileChosen', () => fileName = document.getElementById('pdf_ro').files[0]?.name || '')" style="display: none;">
                                        File selected: <span x-text="fileName"></span>
                                    </div>
                                    @error('pdf_ro')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500">
                                        Accepted file types: Only PDF (max. 10MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <form action="{{ route('ro-approved', $container->id) }}" method="POST"
                                class="w-full sm:flex-1" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="pdf_ro" id="approve_pdf_ro" class="hidden" accept=".pdf">
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('ro-canceled', $container->id) }}" method="POST"
                                class="w-full sm:flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">No Release Orders Found</h2>
                    <p class="text-gray-500">There are currently no release orders available for review.</p>
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
