@extends('layouts.main')

@section('title', 'Seal')
@section('component')
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Seal Management</h1>
            <a href="{{ route('create-seal') }}" wire:navigate
                class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-full shadow hover:bg-red-700 text-center">
                + Seal
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="mb-6 overflow-x-auto -mx-4 sm:mx-0">
            <div class="flex flex-nowrap sm:flex-wrap gap-2 justify-start px-4 sm:px-0 min-w-full">
                <a href="{{ route('seal', ['filter' => 'all']) }}" wire:navigate
                    class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'all' || !request('filter') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All
                </a>
                <a href="{{ route('seal', ['filter' => 'payment proccess']) }}" wire:navigate
                    class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'payment proccess' ? 'bg-blue-400 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Payment Process
                </a>
                <a href="{{ route('seal', ['filter' => 'success']) }}" wire:navigate
                    class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'success' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Success
                </a>
                <a href="{{ route('seal', ['filter' => 'failed']) }}" wire:navigate
                    class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'failed' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Failed
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @forelse ($seals as $seal)
                <div
                    class="bg-white rounded-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-4 sm:p-5">
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-start sm:items-center">
                            <!-- Left Section: Seal Details -->
                            <div class="col-span-1 sm:col-span-8 space-y-3">
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                    <span class="bg-blue-50 text-blue-800 border-blue-200 px-3 py-1 text-xs font-semibold">
                                        {{ $seal->id_seal }}
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($seal->created_at)->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <div>
                                        <p class="text-xs text-gray-500">Pickup Point</p>
                                        <p class="font-medium text-gray-700">{{ ucfirst($seal->pickup_point) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-500">Status:</span>
                                    @php
                                        $statusClasses = [
                                            'Success' => 'bg-green-100 text-green-800 border-green-200',
                                            'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                            'Payment Proccess' => 'bg-blue-50 text-blue-600 border-blue-100',
                                        ];
                                        $statusClass =
                                            $statusClasses[$seal->status] ??
                                            'bg-blue-100 text-blue-800 border-blue-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
                                        <span class="mr-1.5 h-2 w-2 rounded-full"
                                            style="background-color: currentColor"></span>
                                        {{ $seal->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Right Section: Price and Total -->
                            <div class="col-span-1 sm:col-span-4 mt-4 sm:mt-0">
                                <div class="flex flex-col sm:items-end">
                                    <p class="text-sm text-gray-500">Total Price</p>
                                    <p class="text-xl sm:text-2xl font-bold text-indigo-600">
                                        Rp {{ number_format($seal->total_price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="border-r pr-1 border-gray-300">Total</span>
                                        {{ $seal->quantity }} seal
                                    </p>
                                    @if ($seal->status === 'Payment Proccess')
                                        <a href="{{ route('confirmation-seal', $seal->id_seal) }}"
                                            class="w-full sm:w-auto mt-4 inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 no-underline">
                                            <span>Pay</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 sm:p-8 bg-gray-50 rounded-xl">
                    <p class="text-sm text-gray-600">No seals found.</p>
                </div>
            @endforelse
            <div class="flex justify-center mt-6">
                {{ $seals->links() }}
            </div>
        </div>
    </div>
@endsection
