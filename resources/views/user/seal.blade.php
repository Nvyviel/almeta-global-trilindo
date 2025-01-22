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
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'all' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
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
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'canceled' ? 'text-blue-600 underline' : 'text-red-600 hover:text-red-800' }}">
                   Canceled
                </a>
            </nav>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @forelse ($seals as $seal)
                <div class="bg-white rounded-lg shadow-md p-5">
                    <div class="flex items-center justify-between">
                        <!-- Seal Details -->
                        <div>
                            <h2 class="text-lg font-bold text-gray-700">Seal ID: {{ $seal->id_seal }}</h2>
                            <p class="text-sm text-gray-600">
                                Pickup Point: {{ ucfirst($seal->pickup_point) }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Quantity: {{ $seal->quantity }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Total Price: {{ $seal->total_price }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Status: 
                                <span class="font-semibold {{ $seal->status_color_class }}">
                                    {{ ucfirst($seal->status) }}
                                </span>
                            </p>
                        </div>

                        <!-- Price -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-800">Rp {{ number_format($seal->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No seals found for this filter.</p>
            @endforelse
        </div>
    </div>
@endsection
