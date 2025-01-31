@extends('layouts.main')
@section('component')
<div class="min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-12">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-900 flex items-center justify-center md:justify-start gap-3">
                        Release Orders
                    </h1>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 
                    bg-red-200 rounded-full hover:bg-red-300 text-red-700 transition-all 
                    transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-plus"></i>
                    New Release Order
                </a>
            </div>

            <!-- Filter Section -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                    <a href="{{ route('release-order', ['filter' => 'all']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all
                       {{ request('filter', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        All
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Requested']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all
                       {{ request('filter') === 'Requested' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Requested
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Approved']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all
                       {{ request('filter') === 'Approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Approved
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Canceled']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all
                       {{ request('filter') === 'Canceled' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Canceled
                    </a>
                </div>
            </div>

            <!-- Container List -->
            <div class="space-y-6">
                @forelse ($container as $container)
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden 
                                transition-all duration-300 hover:shadow-xl hover:scale-[1.01]">
                        <div class="p-6">
                            <!-- Order Header -->
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                                <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full">
                                    <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'release-order']) }}" 
                                       class="text-lg md:text-xl font-bold text-blue-700 underline hover:text-blue-900 transition-colors">
                                        {{ $container->id_order }}
                                    </a>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($container->status === 'Approved')
                                            bg-green-100 text-green-700
                                        @elseif($container->status === 'Canceled')
                                            bg-red-100 text-red-700
                                        @else 
                                            bg-yellow-100 text-yellow-700
                                        @endif">
                                        {{ $container->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Container Details -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="text-center md:text-left">
                                    <p class="text-xs text-gray-500 mb-1">Total Containers</p>
                                    <p class="font-semibold text-gray-800 text-base md:text-lg flex items-center justify-center md:justify-start gap-2">
                                        <i class="fa-solid fa-box text-blue-500"></i>
                                        {{ $container->quantity }}
                                    </p>
                                </div>
                                <div class="text-center md:text-left">
                                    <p class="text-xs text-gray-500 mb-1">Total Weight</p>
                                    <p class="font-semibold text-gray-800 text-base md:text-lg flex items-center justify-center md:justify-start gap-2">
                                        <i class="fa-solid fa-weight-hanging text-green-500"></i>
                                        {{ $container->weight }} kg
                                    </p>
                                </div>
                            </div>

                            <!-- Shipment Details -->
                            <div class="border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center justify-center md:justify-start gap-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa-solid fa-location-dot text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Departure</p>
                                            <p class="font-semibold text-gray-800 capitalize">
                                                {{ $container->shipment_container->from_city ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden md:block h-px w-10 bg-gray-300 mx-2"></div>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa-solid fa-flag-checkered text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Arrival</p>
                                            <p class="font-semibold text-gray-800 capitalize">
                                                {{ $container->shipment_container->to_city ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-center md:justify-end">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fa-solid fa-calendar-days text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Closing Cargo</p>
                                        <p class="font-semibold text-gray-800">
                                            {{ $container->shipment_container ? \Carbon\Carbon::parse($container->shipment_container->closing_cargo)->translatedFormat('d F Y') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white rounded-xl shadow-md py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 mb-6 mx-auto">
                            <i class="fa-solid fa-box-open text-4xl text-blue-500"></i>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-3">
                            No Release Orders Found
                        </h2>
                        <p class="text-gray-600 max-w-md mx-auto mb-6 px-4">
                            {{ request('filter', 'all') === 'all' 
                                ? "You haven't created any release orders yet. Start by creating your first order."
                                : "No " . request('filter', '') . " orders found." }}
                        </p>
                        <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Create First Order
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection