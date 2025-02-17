@extends('layouts.main')

@section('title', 'Activity Seal')
@section('component')
    <div class="container mx-auto px-4 sm:px-6 py-4 sm:py-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Activity</h2>
            @if (auth()->user()->is_admin == true)
                <a href="{{ route('add-stock') }}" wire:navigate
                    class="w-full sm:w-auto flex items-center justify-center bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Stock
                </a>
            @endif
        </div>

        <div class="space-y-4">
            @forelse($seals as $seal)
                <div
                    class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                            <div class="w-full">
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2">
                                    <div class="flex flex-col">
                                        <div
                                            class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:space-x-3">
                                            <div>
                                                <h5
                                                    class="text-base sm:text-lg font-semibold text-gray-800 flex flex-wrap items-center gap-2">
                                                    {{ $seal->user->name }}
                                                    <span class="text-sm text-gray-500 font-normal">
                                                        (#{{ $seal->id_seal }})
                                                    </span>
                                                </h5>
                                                <p class="text-sm text-gray-500">
                                                    {{ $seal->user->company_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @php
                                            $statusClasses = [
                                                'Success' => 'bg-green-100 text-green-800 border-green-200',
                                                'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                                'Payment Proccess' => 'bg-blue-100 text-blue-800 border-blue-200',
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

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 border-t border-gray-100 pt-4">
                                    <div class="space-y-2">
                                        <p class="text-sm text-gray-600 flex items-start sm:items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 text-blue-500 flex-shrink-0 mt-1 sm:mt-0"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M2 3a1 1 0 011-1h2.5a1 1 0 01.894.553L7.5 5H16a1 1 0 01.894 1.447l-2 4A1 1 0 0114 11H7a1 1 0 01-.894-.553L4.5 6H3a1 1 0 01-1-1V3z" />
                                                <path d="M6 16a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                            <span class="font-medium mr-2">Pickup Point:</span>
                                            {{ ucfirst($seal->pickup_point) }}
                                        </p>
                                        <p class="text-sm text-gray-600 flex items-start sm:items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 text-blue-500 flex-shrink-0 mt-1 sm:mt-0"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium mr-2">Quantity:</span>
                                            {{ $seal->quantity }} seals
                                        </p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-gray-600 flex items-start sm:items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 text-green-500 flex-shrink-0 mt-1 sm:mt-0"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.826c-.314-.105-.639-.25-.93-.428a1 1 0 10-1.154 1.659c.814.564 1.788.88 2.784.88v.092a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 9.766 14 8.991 14 8c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 5.092V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium mr-2">Total Price:</span>
                                            <span class="text-gray-800 font-semibold">
                                                Rp {{ number_format($seal->total_price, 0, ',', '.') }}
                                            </span>
                                        </p>
                                        <p class="text-xs text-gray-500 flex items-start sm:items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-1 text-gray-400 flex-shrink-0 mt-1 sm:mt-0"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Ordered on {{ $seal->created_at->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-md rounded-lg p-6 sm:p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-blue-500 mb-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-gray-600 mb-4">
                        No seal ordered yet.<br>
                    </p>
                </div>
            @endforelse
        </div>

        <div class="flex justify-center mt-4 sm:mt-6">
            {{ $seals->links() }}
        </div>
    </div>
@endsection
