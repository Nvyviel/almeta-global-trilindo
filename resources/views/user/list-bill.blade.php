@extends('layouts.main')

@section('title', 'List Bill of Lading')
@section('component')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bill of Lading</h1>
            <a href="{{ route('create-bill') }}" wire:navigate
                class="px-4 py-2 bg-red-600 text-white rounded-full shadow hover:bg-red-700 transition-all duration-200">
                + Create Bill
            </a>
        </div>

        {{-- Alert Messages --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-sm mb-6"
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
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-sm mb-6" role="alert">
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
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->input('filter', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All Bills
                </a>
                <a href="{{ route('list-bill', ['filter' => 'paid']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->input('filter') === 'paid' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Paid
                </a>
                <a href="{{ route('list-bill', ['filter' => 'unpaid']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->input('filter') === 'unpaid' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Unpaid
                </a>
            </div>
        </div>

        {{-- Bills List --}}
        <div class="space-y-4">
            @forelse ($bills as $bill)
                <div
                    class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-5 grid grid-cols-12 gap-4 items-center">
                        {{-- Left Section: Bill Details --}}
                        <div class="col-span-8 space-y-2">
                            <div class="flex items-center space-x-3">
                                <span class="bg-indigo-50 text-indigo-600 px-3 py-1 text-xs font-semibold">
                                    {{ $bill->bill_id }}
                                </span>
                                <span class="text-sm text-gray-500">
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
                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                        <span class="mr-1.5 h-2 w-2 rounded-full"
                                            style="background-color: currentColor"></span>
                                        {{ $bill->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <p class="font-medium text-gray-700">{{ $bill->user->company_name }}</p>
                                    <p class="font-medium text-xs text-gray-500">Company</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700">{{ $bill->shipment->vessel_name }}</p>
                                    <p class="font-medium text-xs text-gray-500">Vessel</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700">
                                        {{ strtoupper($bill->shipment->from_city) }} →
                                        {{ strtoupper($bill->shipment->to_city) }}
                                        @if ($bill->status === 'Paid')
                                            <i
                                                class="fa-solid fa-check text-xs text-green-800 bg-green-100 rounded-full py-1 px-2"></i>
                                        @endif
                                    </p>
                                    <p class="font-medium text-xs text-gray-500">Route</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right Section: Action Buttons --}}
                        <div class="col-span-4 flex justify-end space-x-3">
                            @if ($bill->status === 'Unpaid')
                                <button wire:click="payBill({{ $bill->id }})"
                                    class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full hover:bg-green-100">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            @endif
                            <a href="{{ route('detail-bill', $bill->id) }}"
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
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No bills found.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $bills->links() }}
        </div>
    </div>
@endsection
