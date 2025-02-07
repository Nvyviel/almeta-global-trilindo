@extends('layouts.main')

@section('component')
    <div class="mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Shipping Instructions</h1>
        </div>

        <!-- Navigation Menu -->
        <div class="flex justify-between items-center mb-6">
            <nav class="space-x-4">
                <a href="{{ route('shipping-instruction', ['filter' => 'all']) }}" wire:navigate
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'all' || !request('filter') ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    All
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'requested']) }}" wire:navigate
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'requested' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    Requested
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'approved']) }}" wire:navigate
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'approved' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    Approved
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'rejected']) }}" wire:navigate
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'rejected' ? 'text-red-600 underline' : 'text-gray-600 hover:text-red-800' }}">
                    Rejected
                </a>
            </nav>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @php
                $consolidatedInstructions = $shippingInstructions->groupBy('container.id_order');
            @endphp

            @forelse($consolidatedInstructions as $orderId => $instructions)
                <div
                    class="bg-white rounded-xl border border-gray-200 p-5 flex justify-between items-center hover:shadow-lg transition duration-300">
                    <!-- Left: Informasi Container -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $orderId }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($instructions->first()->created_at)->format('d M Y') }}
                        </p>
                        <div class="mt-2">
                            <p class="text-gray-700">
                                {{ $instructions->first()->container->shipment_container->vessel_name ?? 'No Vessel Name' }}
                            </p>
                            <p class="text-gray-700">
                                {{ $instructions->first()->container->container_type ?? 'Unknown' }}
                            </p>
                            @if ($instructions->count() > 1)
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $instructions->count() }} shipping instructions
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Tombol Aksi -->
                    <div class="flex space-x-3">
                        <!-- Approve Button for first instruction (will trigger all for the order) -->
                        <form action="{{ route('approved-si', $instructions->first()->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="px-4 py-2 bg-green-100 text-green-700 rounded-full hover:bg-green-200">
                                Approve
                            </button>
                        </form>

                        <!-- Reject Button for first instruction (will trigger all for the order) -->
                        <form action="{{ route('rejected-si', $instructions->first()->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-full hover:bg-red-200">
                                Reject
                            </button>
                        </form>

                        <!-- View Detail Button -->
                        <a href="{{ route('detail-si', $instructions->first()->id) }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full hover:bg-indigo-100">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center p-8 bg-gray-50 rounded-xl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No shipping instructions found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $shippingInstructions->links() }}
        </div>
    </div>
@endsection
