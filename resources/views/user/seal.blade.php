@extends('layouts.main')

@section('title', 'Seal')
@section('component')
    <div class="mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Seal Management</h1>
            <a href="{{ route('create-seal') }}" wire:navigate
                class="px-4 py-2 bg-red-600 text-white rounded-full shadow hover:bg-red-700">
                + Seal
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <a href="{{ route('seal', ['filter' => 'all']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'all' || !request('filter') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All
                </a>
                <a href="{{ route('seal', ['filter' => 'payment proccess']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'payment proccess' ? 'bg-blue-400 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Payment Proccess
                </a>
                <a href="{{ route('seal', ['filter' => 'success']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'success' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Success
                </a>
                <a href="{{ route('seal', ['filter' => 'failed']) }}" wire:navigate
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('filter') === 'failed' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Failed
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="space-y-4">
            @forelse ($seals as $seal)
                <div
                    class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="p-5 grid grid-cols-12 gap-4 items-center">
                        <!-- Left Section: Seal Details -->
                        <div class="col-span-8 space-y-2">
                            <div class="flex items-center space-x-3">

                                <span class="bg-blue-200 text-blue-800 border-blue-200 px-3 py-1 text-xs font-semibold">
                                    {{ $seal->id_seal }}
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
                            </div>

                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">Status:</span>
                                @php
                                    $statusClasses = [
                                        'Success' => 'bg-green-100 text-green-800 border-green-200',
                                        'Canceled' => 'bg-red-100 text-red-800 border-red-200',
                                        'Payment Proccess' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    ];
                                    $statusClass =
                                        $statusClasses[$seal->status] ?? 'bg-blue-100 text-blue-800 border-blue-200';
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $statusClass }} border">
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
                                <span class="border-r pr-1 border-gray-300">Total</span>
                                {{ $seal->quantity }} seal
                            </p>
                            @if ($seal->status === 'Payment Proccess')
                                <form id="payment-form">
                                    @csrf
                                    <button type="button" data-seal-id="{{ $seal->id_seal }}"
                                        onclick="getSnapToken({{ $seal->id_seal }})"
                                        class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span>Pay Now</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-8 bg-gray-50 rounded-xl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No seals found.</p>
                </div>
            @endforelse
            <div class="flex justify-center mt-6">
                {{ $seals->links() }}
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script>
            function getSnapToken(sealId) {
                const button = document.querySelector(`button[data-seal-id="${sealId}"]`);
                if (button) {
                    button.disabled = true;
                }

                fetch(`/get-snap-token/seal/ ${sealId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            if (button) button.disabled = false;
                            return;
                        }

                        window.snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                alert('Payment Success');
                                window.location.href = '/dashboard';
                            },
                            onPending: function(result) {
                                alert('Waiting for payment');
                                window.location.href = '/dashboard';
                            },
                            onError: function(result) {
                                alert('Payment Failed');
                                if (button) button.disabled = false;
                            },
                            onClose: function() {
                                alert('Payment modal closed');
                                if (button) button.disabled = false;
                            }
                        });
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan saat memproses pembayaran');
                        if (button) button.disabled = false;
                    });
            }
        </script>
    @endpush
@endsection
