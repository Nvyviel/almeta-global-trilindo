@extends('layouts.main')

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

        @if ($bills->isEmpty())
            <p class="text-center text-gray-500">No Bills Here</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($bills as $bill)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Bill #{{ $bill->id }}</h3>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-medium
                        @if ($bill->status === 'Paid') bg-green-100 text-green-800
                        @else
                            bg-yellow-100 text-yellow-800 @endif">
                                    {{ $bill->status }}
                                </span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Company</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $bill->user->company_name }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Vessel</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $bill->shipment->vessel_name }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Created</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $bill->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('bills.show', $bill->id) }}"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Details
                                    <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
