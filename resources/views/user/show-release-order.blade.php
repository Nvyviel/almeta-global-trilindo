@extends('layouts.fullscreen')

@section('title','Detail')
@section('component')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-gray-900">
                        <i class="fa-solid fa-ship text-blue-600 mr-3"></i>
                        <span class="text-blue-900">{{ $container->id_order }}</span>
                    </h1>
                    <div class="flex items-center space-x-4">
                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold {{ $container->status == 'Requested'
                                ? 'bg-yellow-100 text-yellow-700'
                                : ($container->status == 'Approved'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700') }}">
                            {{ $container->status }}
                        </span>
                        @if ($container->status == 'Approved')
                            @if ($container->{'pdf-ro'})
                                <a href="{{ asset('storage/' . $container->{'pdf-ro'}) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors duration-150">
                                    <i class="fa-solid fa-download mr-2"></i>
                                    Download RO
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <!-- Primary Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Stuffing</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->stuffing }}</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Container Type</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->container_type }}</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Ownership</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->ownership_container }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Load Type</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->load_type }}</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Commodity</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->commodity }}</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500">Created Date</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $container->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Secondary Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fa-solid fa-weight-scale"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Weight</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $container->weight }} kg</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Quantity</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $container->quantity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div
                                class="p-3 rounded-full {{ $container->is_danger === 'Yes' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                <i
                                    class="fa-solid {{ $container->is_danger === 'Yes' ? 'fa-triangle-exclamation' : 'fa-circle-check' }}"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Danger Status</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $container->is_danger ? 'No' : 'Yes' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Notes</h3>
                    <p class="text-gray-700">{{ $container->notes ?? 'No additional notes' }}</p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex items-center">
                <a href="{{ route(request('source', 'release-order')) }}" wire:navigate
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors duration-150">
                    <i class="fa-solid fa-arrow-left-long mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
