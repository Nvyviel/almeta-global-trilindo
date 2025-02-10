@extends('layouts.main')

@section('title', 'List Bill of Lading')
@section('component')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Alert Messages --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm transition-all duration-500 ease-in-out"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($bills as $bill)
                <div
                    class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-5 grid grid-cols-12 gap-4 items-center">
                        <!-- Left Section: Bill Details -->
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
                                            'bg-yellow-100 text-yellow-800 border-yellow-200';
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
                                    <p class="font-medium text-gray-700">{{ strtoupper($bill->shipment->from_city) }} →
                                        {{ strtoupper($bill->shipment->to_city) }}
                                        <i class="fa-solid fa-check text-xs text-green-800 bg-green-100 rounded-full py-1 px-2"></i>
                                    </p>
                                    <p class="font-medium text-xs text-gray-500">From - To</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Action Button -->
                        <div class="col-span-4 text-right">
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
    </div>
@endsection
