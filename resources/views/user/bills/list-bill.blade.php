@extends('layouts.main')

@section('title', 'List Bills')
@section('component')
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Bills</h1>
        </div>

        {{-- Alert Messages --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-sm mb-6"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-sm mb-6"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Filter Navigation --}}
        <div class="mb-6">
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <a href="{{ route('list-bill', ['filter' => 'all']) }}" wire:navigate
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs sm:text-sm font-medium transition-all {{ request()->input('filter', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All Bills
                </a>
                <a href="{{ route('list-bill', ['filter' => 'paid']) }}" wire:navigate
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs sm:text-sm font-medium transition-all {{ request()->input('filter') === 'paid' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Paid
                </a>
                <a href="{{ route('list-bill', ['filter' => 'unpaid']) }}" wire:navigate
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs sm:text-sm font-medium transition-all {{ request()->input('filter') === 'unpaid' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Unpaid
                </a>
            </div>
        </div>

        {{-- Bills List --}}
        <div class="space-y-4">
            @forelse ($bills as $bill)
                <div
                    class="bg-white border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-3 sm:p-5 grid grid-cols-1 sm:grid-cols-12 gap-4 items-start sm:items-center">
                        {{-- Left Section: Bill Details --}}
                        <div class="sm:col-span-12 md:col-span-8 space-y-2">
                            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-3">
                                <span class="bg-indigo-50 text-indigo-600 px-2 py-1 text-xs font-semibold">
                                    {{ $bill->bill_id }}
                                </span>
                                <span class="text-xs sm:text-sm text-gray-500">
                                    {{ $bill->created_at->format('d M Y') }}
                                </span>
                                <div class="flex items-center space-x-2">
                                    @php
                                        $statusClasses = [
                                            'Paid' => 'bg-green-100 text-green-800 border-green-200',
                                            'Unpaid' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        ];
                                        $statusClass =
                                            $statusClasses[$bill->status] ??
                                            'bg-gray-100 text-gray-800 border-gray-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                        <span class="mr-1.5 h-2 w-2 rounded-full"
                                            style="background-color: currentColor"></span>
                                        {{ $bill->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                                <div class="mb-2 sm:mb-0">
                                    <p class="font-medium text-sm sm:text-base text-gray-700">
                                        {{ $bill->user->company_name }}</p>
                                    <p class="font-medium text-xs text-gray-500">Company</p>
                                </div>
                                <div class="mb-2 sm:mb-0">
                                    <p class="font-medium text-sm sm:text-base text-gray-700">
                                        {{ $bill->shipment->vessel_name }}</p>
                                    <p class="font-medium text-xs text-gray-500">Vessel</p>
                                </div>
                                <div>
                                    <p class="font-medium text-sm sm:text-base text-gray-700">
                                        {{ strtoupper($bill->shipment->from_city) }} →
                                        {{ strtoupper($bill->shipment->to_city) }}
                                        @if ($bill->status === 'Paid')
                                            <i
                                                class="fa-solid fa-check text-xs text-green-800 bg-green-100 rounded-full py-0.5 px-1.5"></i>
                                        @endif
                                    </p>
                                    <p class="font-medium text-xs text-gray-500">Route</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right Section: Action Buttons --}}
                        <div class="sm:col-span-12 md:col-span-4 flex justify-start sm:justify-end space-x-3 mt-4 sm:mt-0">
                            @if ($bill->status === 'Unpaid')
                                <form id="payment-form">
                                    @csrf
                                    <button type="button" onclick="payBill({{ $bill->id }})"
                                        class="inline-flex items-center px-3 py-3 sm:px-4 sm:py-4 bg-green-50 text-green-700 rounded-full hover:bg-green-100">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('detail-bill', $bill->id) }}"
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
                    <p class="mt-4 text-sm text-gray-600">No bills found.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $bills->links() }}
        </div>
    </div>
@endsection
