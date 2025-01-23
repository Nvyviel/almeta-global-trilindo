@extends('layouts.main')

@section('component')
    <div class="mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Seal Management</h1>
            <a href="{{ route('showListSeal') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
               + Seal
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="flex justify-between items-center mb-6">
            <nav class="space-x-4">
                <a href="{{ route('seal', ['filter' => 'all']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'all' || !request('filter') ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Semua
                </a>
                <a href="{{ route('seal', ['filter' => 'requested']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'requested' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Requested
                </a>
                <a href="{{ route('seal', ['filter' => 'under_verification']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'under_verification' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Under Verification
                </a>
                <a href="{{ route('seal', ['filter' => 'ready']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'ready' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Ready
                </a>
                <a href="{{ route('seal', ['filter' => 'canceled']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'canceled' ? 'text-red-600 underline' : 'text-gray-600 hover:text-red-800' }}">
                   Canceled
                </a>
            </nav>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
        @forelse ($seals as $seal)
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="p-5 grid grid-cols-12 gap-4 items-center">
                    <!-- Left Section: Seal Details -->
                    <div class="col-span-8 space-y-2">
                        <div class="flex items-center space-x-3">
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-semibold">
                                Seal ID: {{ $seal->id_seal }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($seal->created_at)->format('d M Y') }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs text-gray-500">Pickup Point</p>
                                <p class="font-medium text-gray-700">{{ ucfirst($seal->pickup_point) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Quantity</p>
                                <p class="font-medium text-gray-700">{{ $seal->quantity }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-500">Status:</span>
                            @php
                                $statusClasses = [
                                    'Success' => 'bg-green-100 text-green-800 border-green-200',
                                    'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                ];
                                $statusClass = $statusClasses[$seal->status] ?? 'bg-blue-100 text-blue-800 border-blue-200';
                            @endphp
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                <span class="mr-1.5 h-2 w-2 rounded-full" style="background-color: currentColor"></span>
                                {{ $seal->status }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Right Section: Price and Total -->
                    <div class="col-span-4 text-right">
                        <p class="text-sm text-gray-500">Total Price</p>
                        <p class="text-2xl font-bold text-indigo-600">
                            Rp {{ number_format($seal->total_price, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            @ Rp {{ number_format($seal->price, 0, ',', '.') }} / unit
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center p-8 bg-gray-50 rounded-xl">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-4 text-sm text-gray-600">No seals found for this filter.</p>
            </div>
        @endforelse
        </div>
    </div>
@endsection
