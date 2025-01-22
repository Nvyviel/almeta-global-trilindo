@extends('layouts.main')
@section('component')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section with improved styling -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-blue-900 flex items-center justify-center gap-3">
                <i class="fa-solid fa-ship text-blue-600"></i>
                Release Order (RO)
            </h1>
            <p class="mt-2 text-gray-600">Manage your container release orders efficiently</p>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto">
            @forelse (auth()->user()->container as $container)
                <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden 
                            transition-all duration-300 hover:shadow-lg hover:border-blue-200">
                    <div class="p-6">
                        <!-- Header with Status -->
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-4">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    <i class="fa-solid fa-box text-blue-500 mr-2"></i>
                                    {{ $container->id_order }}
                                </h2>
                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold
                                    @if($container->status === 'Approved')
                                        bg-green-100 text-green-700 border border-green-200
                                    @elseif($container->status === 'Canceled')
                                        bg-red-100 text-red-700 border border-red-200
                                    @else 
                                        bg-yellow-100 text-yellow-700 border border-yellow-200
                                    @endif">
                                    {{ $container->status }}
                                </span>
                            </div>
                            <a href="{{ route('show-detail', ['id' => $container->id, 'source' => 'release-order']) }}" 
                               class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                View Details
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Container Information Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Stuffing & Ownership Section -->
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Stuffing</h3>
                                    <p class="text-gray-900">{{ $container->stuffing }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Ownership</h3>
                                    <p class="text-gray-900">{{ $container->ownership_container }}</p>
                                </div>
                            </div>

                            <!-- Load & Container Type Section -->
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Load Type</h3>
                                    <p class="text-gray-900">{{ $container->load_type }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Container Type</h3>
                                    <p class="text-gray-900">{{ $container->container_type }}</p>
                                </div>
                            </div>

                            <!-- Commodity & Danger Section -->
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Commodity</h3>
                                    <p class="text-gray-900">{{ $container->commodity }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Danger Status</h3>
                                    <p class="@if($container->is_danger === 'Yes') text-red-600 @else text-green-600 @endif font-medium">
                                        {{ $container->is_danger ? 'Non-Dangerous Goods' : 'Dangerous Goods' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Quantity & Weight</h3>
                                <p class="text-gray-900">
                                    {{ $container->quantity }} units | {{ $container->weight }} kg
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Notes</h3>
                                <p class="text-gray-700">{{ $container->notes ?? 'No additional notes' }}</p>
                            </div>
                        </div>

                        <!-- Footer with Creation Date -->
                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center text-sm text-gray-500">
                            <span>
                                <i class="fa-regular fa-calendar mr-1"></i>
                                Created: {{ $container->created_at->format('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fa-solid fa-box-open text-3xl text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                        No Release Orders Found
                    </h2>
                    <p class="text-gray-600 max-w-md mx-auto">
                        There are currently no release orders in your account. New orders will appear here once created.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection