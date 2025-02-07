@extends('layouts.main')
@section('component')
    <div class="min-h-screen">
        <div class="container mx-auto">
            <!-- Header Section -->
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Release Orders</h1>
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="px-4 py-2 bg-red-200 text-red-700 rounded-full shadow hover:bg-red-300">
                        + Release Order
                    </a>
                </div>

                <!-- Filter Section -->
                <div class="mb-6">
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                        <a href="{{ route('release-order', ['filter' => 'all']) }}" wire:navigate
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('filter', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            All
                        </a>
                        <a href="{{ route('release-order', ['filter' => 'Requested']) }}" wire:navigate
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('filter') === 'Requested' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            Requested
                        </a>
                        <a href="{{ route('release-order', ['filter' => 'Approved']) }}" wire:navigate
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('filter') === 'Approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            Approved
                        </a>
                        <a href="{{ route('release-order', ['filter' => 'Canceled']) }}" wire:navigate
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('filter') === 'Canceled' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            Canceled
                        </a>
                    </div>
                </div>

                <!-- Container List -->
                <div class="space-y-4">
                    @forelse ($container as $container)
                        <div
                            class="bg-white border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <div class="p-5 grid grid-cols-12 gap-4 items-center">
                                <!-- Left Section: Container Details -->
                                <div class="col-span-8 space-y-2">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="bg-indigo-50 text-indigo-600 px-3 py-1 border text-xs font-semibold">
                                            {{ $container->id_order }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}
                                        </span>
                                        <div class="flex items-center space-x-2">
                                            @php
                                                $statusClasses = [
                                                    'Approved' => 'bg-green-100 text-green-800 border-green-200',
                                                    'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                                    'Requested' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                ];
                                                $statusClass =
                                                    $statusClasses[$container->status] ??
                                                    'bg-yellow-100 text-yellow-800 border-yellow-200';
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                                <span class="mr-1.5 h-2 w-2 rounded-full"
                                                    style="background-color: currentColor"></span>
                                                {{ $container->status }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <p class="font-medium text-gray-700">
                                                {{ strtoupper($container->shipment_container->from_city ?? 'N/A') }} →
                                                {{ strtoupper($container->shipment_container->to_city ?? 'N/A') }}
                                            </p>
                                            <p class="font-medium text-xs text-gray-500">
                                                Closing:
                                                {{ $container->shipment_container ? \Carbon\Carbon::parse($container->shipment_container->closing_cargo)->format('d M Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500">Total:</span>
                                            <span
                                                class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                                {{ $container->quantity }} container
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500">Weight:</span>
                                            <span
                                                class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                                {{ $container->weight }} kg
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Section: Action Button -->
                                <div class="col-span-4 text-right">
                                    <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'release-order']) }}" wire:navigate
                                        class="inline-flex items-center px-4 py-4 bg-indigo-50 text-indigo-700 rounded-full hover:bg-indigo-100">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-8 bg-gray-50 rounded-xl">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-4 text-sm text-gray-600">
                                {{ request('filter', 'all') === 'all'
                                    ? "You haven't created any release orders yet. Start by creating your first order."
                                    : 'No ' . request('filter', '') . ' orders found.' }}
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
