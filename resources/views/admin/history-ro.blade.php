@extends('layouts.fullscreen')

@section('title', 'History Release Order')
@section('component')
    <div class="min-h-screen bg-gray-50 px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="max-w-7xl mx-auto mb-6 pt-6">
            <a href="{{ route('approval-ro') }}" wire:navigate
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Approval
            </a>
        </div>

        <!-- History Container Section -->
        <div class="max-w-4xl mx-auto space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">History</h2>

            @forelse ($containers as $container)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div class="space-y-2">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    <i
                                        class="fa-solid fa-building mr-2 text-blue-600"></i>{{ $container->user->company_name }}
                                </h2>
                                <div>
                                    @php
                                        $statusClasses = [
                                            'Approved' => 'bg-green-100 text-green-800 border-green-200',
                                            'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                            'Requested' => 'bg-yellow-100 text-yellow-800 border-yellow-200'
                                        ];
                                        $statusClass = $statusClasses[$container->status] ?? '';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                        <span class="mr-1.5 h-2 w-2 rounded-full"
                                            style="background-color: currentColor"></span>
                                        {{ $container->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                <i class="fa-regular fa-calendar mr-1"></i>
                                Completed: {{ $container->updated_at->format('Y-m-d') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Commodity</span>
                                <p class="text-gray-900 text-lg">{{ $container->commodity }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Quantity</span>
                                <p class="text-gray-900 text-lg">{{ $container->quantity }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="text-sm font-medium text-gray-600 block mb-1">Vessel</span>
                                <p class="text-gray-900 text-lg">{{ $container->shipment_container->vessel_name }}</p>
                            </div>
                        </div>
                        @if ($container->pdf_ro)
                                <div class="mt-4">
                                    <a href="{{ asset('storage/' . $container->pdf_ro) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200"
                                        target="_blank">
                                        <i class="fa-solid fa-file-pdf mr-2"></i>
                                        View RO Document
                                    </a>
                                </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl shadow-md">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        No History Found
                    </h2>
                    <p class="text-gray-500 max-w-sm mx-auto">
                        There are currently no completed containers to display.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
