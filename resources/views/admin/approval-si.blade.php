@extends('layouts.main')

@section('title', 'Approval Shipping Instructions')
@section('component')
    <div class="container mx-auto px-4 py-6">
        <!-- Back Button and History Button -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('history-si') }}" wire:navigate
                class="flex items-center text-gray-600 hover:text-gray-800 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                History
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="bg-gray-50 p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Filter Vessel</h2>
            </div>
            <div class="p-4">
                <form method="GET" action="{{ route('approval-si') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="selectedVessel" class="block text-sm font-medium text-gray-600 mb-1">Select
                                Vessel</label>
                            <select id="selectedVessel" name="selectedVessel"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                                <option value="">Choose a Vessel</option>
                                @foreach ($availableVessel as $name)
                                    <option value="{{ $name }}"
                                        {{ request('selectedVessel') == $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-600 mb-1">Search</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Search by commodity or company..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>

                        <div>
                            <label for="instructions_id" class="block text-sm font-medium text-gray-600 mb-1">Release Order ID
                                ID</label>
                            <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}" placeholder="Search by Release Order ID..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Data
                        </button>

                        <a href="{{ route('approval-si') }}" wire:navigate
                            class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300 flex items-center justify-center">
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
                    <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
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

        <!-- Shipping Instructions Cards -->
        <div class="space-y-4">
            @php
                $groupedInstructions = $shippingInstructions->groupBy('container.order_id');
            @endphp

            @forelse($groupedInstructions as $orderId => $instructions)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h2 class="text-xl font-semibold text-gray-900">
                                        {{ $instructions->first()->consignee->industry ?? 'No Industry' }}
                                    </h2>
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-400"></span>
                                    {{ $instructions->first()->status }}
                                </span>
                            </div>
                            <a href="{{ route('detail-si', $instructions->first()->id) }}" wire:navigate
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Container List -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Vessel Name</span>
                                <p class="text-gray-900 font-semibold">
                                    {{ $instructions->first()->container->shipment_container->vessel_name ?? 'No Vessel Name' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Container Type</span>
                                <p class="text-gray-900 font-semibold">
                                    {{ $instructions->first()->container->container_type ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Created Date</span>
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($instructions->first()->created_at)->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="space-y-2">
                                <div x-data="{ fileChosen: false }" class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Upload Shipping Instruction Document
                                    </label>
                                    <div class="mt-1 flex items-center space-x-4">
                                        <div class="flex-1">
                                            <label
                                                class="flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200 @error('si_file') border-red-500 @enderror">
                                                <input type="file" name="si_file" id="si_file" class="sr-only"
                                                    accept=".pdf" x-on:change="fileChosen = true" required>
                                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="text-sm text-gray-600">Choose file or drag and drop</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div x-show="fileChosen" class="text-sm text-gray-500" x-data="{ fileName: '' }"
                                        x-init="$watch('fileChosen', () => fileName = document.getElementById('si_file').files[0]?.name || '')" style="display: none;">
                                        File selected: <span x-text="fileName"></span>
                                    </div>
                                    @error('si_file')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500">
                                        Accepted file types: Only PDF (max. 10MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-3">
                            <form action="{{ route('approved-si', $instructions->first()->id) }}" method="POST"
                                enctype="multipart/form-data" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="file" name="si_file" id="approve_si_file" class="hidden"
                                    accept=".pdf">
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('rejected-si', $instructions->first()->id) }}" method="POST"
                                class="flex-1">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
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
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">No Shipping Instructions Found</h2>
                    <p class="text-gray-500">There are currently no shipping instructions available for review.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $shippingInstructions->links() }}
        </div>
    </div>

    <script>
        document.getElementById('si_file').addEventListener('change', function(e) {
            // Get the selected file
            const file = e.target.files[0];

            // Create a new FileList object
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set the file to the hidden input
            document.getElementById('approve_si_file').files = dataTransfer.files;
        });
    </script>
@endsection
