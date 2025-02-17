@extends('layouts.main')

@section('title', 'Shipping Instruction')
@section('component')
    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <!-- Header with improved spacing and visual hierarchy -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Shipping Instructions</h1>
            <a href="{{ route('request-si') }}" wire:navigate
                class="w-full sm:w-auto px-5 py-2.5 bg-red-600 text-white rounded-full shadow-md hover:bg-red-700 transition duration-200 ease-in-out text-center flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span>New Instruction</span>
            </a>
        </div>

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

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
            @forelse ($containers as $container)
                <div
                    class="bg-white border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-xl rounded-xl group">
                    <div class="p-5 sm:p-6">
                        <!-- Status Badge - Positioned prominently at top -->
                        <div class="flex justify-between items-start mb-4">
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
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }} border">
                                <span class="mr-1.5 h-2 w-2 rounded-full" style="background-color: currentColor"></span>
                                {{ $container->shippingInstructions->first()?->status }}
                            </span>
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 text-xs font-semibold">
                                {{ $container->quantity }} Instructions
                            </span>
                        </div>

                        <!-- Main Content - Industry & Container Information -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 text-lg mb-2">
                                Consignee {{ optional($container->shippingInstructions->first()->consignee)->industry ?? 'No Consignee Industry' }}
                            </h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>{{ $container->container_type }}</span>
                            </div>
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}
                            </div>
                        </div>

                        <!-- Action Button with improved positioning and animation -->
                        <div class="text-right">
                            <a href="{{ route('shipping-instruction-detail', $container->id) }}" wire:navigate
                                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition duration-200 ease-in-out group-hover:shadow-md">
                                <span class="mr-2">View Details</span>
                                <svg class="h-4 w-4 transform group-hover:translate-x-1 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-8 bg-gray-50 rounded-xl col-span-full">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-700">No shipping instructions found</h3>
                    <p class="mt-2 text-sm text-gray-500">Try changing your filter criteria or create a new shipping
                        instruction.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination with improved styling -->
        <div class="mt-10">
            {{ $containers->links() }}
        </div>
    </div>
@endsection
