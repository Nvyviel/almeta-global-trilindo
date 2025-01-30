@extends('layouts.main')

@section('component')
    <div class="mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Shipping Instructions</h1>
            <a href="{{ route('request-si') }}" 
               class="px-4 py-2 bg-red-200 text-red-700 rounded-full shadow hover:bg-red-300">
               + Shipping Instruction
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="flex justify-between items-center mb-6">
            <nav class="space-x-4">
                <a href="{{ route('shipping-instruction', ['filter' => 'all']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'all' || !request('filter') ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   All
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'requested']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'requested' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Requested
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'approved']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'approved' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                   Approved
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'rejected']) }}" 
                   class="px-3 py-2 text-sm font-medium {{ request('filter') === 'rejected' ? 'text-red-600 underline' : 'text-gray-600 hover:text-red-800' }}">
                   Rejected
                </a>
            </nav>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @forelse ($containers as $container)
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-5 grid grid-cols-12 gap-4 items-center">
                        <!-- Left Section: Container Details -->
                        <div class="col-span-8 space-y-2">
                            <div class="flex items-center space-x-3">
                                <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $container->id_order }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <p class="font-medium text-gray-700">{{ $container->shipment_container->vessel_name ?? 'No Vessel Name' }}</p>
                                    <p class="font-medium text-xs text-gray-500">{{ $container->container_type }}</p>
                                </div>  
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">Total:</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                    - {{ $container->quantity }} container
                                </span>
                            </div>
                        </div>
                        
                        <!-- Right Section: Action Button -->
                        <div class="col-span-4 text-right">
                            <a href="{{ route('shipping-instruction-detail', $container->id) }}" 
                               class="inline-flex items-center px-4 py-4 bg-indigo-50 text-indigo-700 rounded-full hover:bg-indigo-100">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-8 bg-gray-50 rounded-xl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No shipping instructions found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $containers->links() }}
        </div>
    </div>
@endsection