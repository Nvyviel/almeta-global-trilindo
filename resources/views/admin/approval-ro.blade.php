@extends('layouts.main')

@section('component')
   <div class="min-h-screen px-4 sm:px-6 lg:px-8">
        <!-- Back Button and History Button -->
        <div class="max-w-7xl mx-auto mb-6 pt-6 flex justify-between items-center">
            <a href="{{ route('approval-list') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Approval List
            </a>
            <a href="{{ route('history-ro') }}" wire:navigate class="inline-flex items-center px-4 text-sm rounded-md transition duration-200">
                <i class="fa-solid fa-clock-rotate-left mr-2 text-sm"></i> / History
            </a>
        </div>

        <!-- Search and Filter Section -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-800">
                    <h2 class="text-2xl font-bold text-white text-center">Filtering Vessel</h2>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('approval-ro') }}" class="space-y-4">
                        <!-- Rest of the filter form remains the same -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="selectedVessel" class="block text-sm font-medium text-gray-700 mb-1">Select Vessel</label>
                                <select 
                                    id="selectedVessel"
                                    name="selectedVessel"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white shadow-sm"
                                >
                                    <option value="">Choose a Vessel</option>
                                    @foreach($availableVessel as $name)
                                        <option value="{{ $name }}" {{ request('selectedVessel') == $name ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input 
                                    type="text" 
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search by commodity or company..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                                >
                            </div>
                        </div>

                        <div class="flex space-x-4 pt-2">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm">
                                <i class="fa-solid fa-filter mr-2"></i>Filter Data
                            </button>

                            <a href="{{ route('approval-ro') }}" wire:navigate class="flex-1 bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg text-center hover:bg-gray-200 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-sm">
                                <i class="fa-solid fa-rotate mr-2"></i>Reset
                            </a>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-r-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Container Cards -->
        <div class="max-w-4xl mx-auto space-y-6">
            @forelse ($name_ship->where('status', 'Requested') as $container)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div class="space-y-2">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    <i class="fa-solid fa-building mr-2 text-blue-600"></i>{{ $container->user->company_name }}
                                </h2>
                                <div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border-yellow-200">
                                        <span class="mr-1.5 h-2 w-2 rounded-full" style="background-color: currentColor"></span>
                                        {{ $container->status }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'approval-list']) }}" wire:navigate
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                <i class="fa-solid fa-arrow-right text-xl"></i>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Commodity</span>
                                <p class="text-gray-900 text-lg">{{ strtoupper($container->commodity) }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Quantity</span>
                                <p class="text-gray-900 text-lg">{{ $container->quantity }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Vessel</span>
                                <p class="text-gray-900 text-lg">{{ $container->shipment_container->vessel_name }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-4">
                            <form action="{{ route('ro-approved', $container->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-sm">
                                    <i class="fa-solid fa-check mr-2"></i>
                                    Approve
                                </button>
                            </form>
                            
                            <form action="{{ route('ro-canceled', $container->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 shadow-sm">
                                    <i class="fa-solid fa-times mr-2"></i>
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl shadow-md">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        No Release Orders Found
                    </h2>
                    <p class="text-gray-500 max-w-sm mx-auto">
                        There are currently no release orders available for review.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection