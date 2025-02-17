@extends('layouts.main')

@section('title', 'Shipping Instruction')
@section('component')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Shipping Instructions</h1>
            <a href="{{ route('request-si') }}" wire:navigate
                class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-full shadow hover:bg-red-700 text-center">
                + Shipping Instruction
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="mb-6 overflow-x-auto -mx-4 px-4">
            <div class="flex flex-nowrap gap-2 justify-start min-w-max py-1">
                <a href="{{ route('shipping-instruction', ['filter' => 'all']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap {{ request('filter', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'requested']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap {{ request('filter') === 'requested' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Requested
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'approved']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap {{ request('filter') === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Approved
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'rejected']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap {{ request('filter') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Rejected
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @forelse ($containers as $container)
                <div
                    class="bg-white border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 rounded-lg">
                    <div class="p-4 sm:p-5">
                        <!-- Top Section: ID, Date, Status -->
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 text-xs font-semibold">
                                {{ $container->quantity }} Instructions
                            </span>
                            <span class="text-xs sm:text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}
                            </span>
                            <div class="flex items-center space-x-2 ml-auto sm:ml-0">
                                @php
                                    $statusClasses = [
                                        'Approved' => 'bg-green-100 text-green-800 border-green-200',
                                        'Rejected' => 'bg-red-100 text-red-800 border-red-200',
                                        'Requested' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    ];
                                    $statusClass =
                                        $statusClasses[$container->shippingInstructions->first()?->status] ??
                                        'bg-yellow-100 text-yellow-800 border-yellow-200';
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                    <span class="mr-1.5 h-2 w-2 rounded-full" style="background-color: currentColor"></span>
                                    {{ $container->shippingInstructions->first()?->status }}
                                </span>
                            </div>
                        </div>

                        <!-- Middle Section: Industry & Container Type -->
                        <div class="mb-4">
                            <p class="font-medium text-gray-700 text-sm sm:text-base">
                                {{ optional($container->shippingInstructions->first()->consignee)->industry ?? 'No Consignee Industry' }}
                            </p>
                            <p class="font-medium text-xs text-gray-500">{{ $container->container_type }}</p>
                        </div>

                        <!-- Bottom Section: Action Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('shipping-instruction-detail', $container->id) }}" wire:navigate
                                class="inline-flex items-center px-3 py-3 sm:px-4 sm:py-4 bg-indigo-50 text-indigo-700 rounded-full hover:bg-indigo-100">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 sm:p-8 bg-gray-50 rounded-xl">
                    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No shipping instructions found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $containers->links() }}
        </div>
    </div>
@endsection
