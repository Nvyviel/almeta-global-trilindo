@extends('layouts.main')

@section('component')
    <div class="mx-auto">
        {{-- @livewire('seal-payment') --}}
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Seal Management</h1>
            <a href="{{ route('showListSeal') }}"
                class="px-4 py-2 bg-red-200 text-red-700 rounded-full shadow hover:bg-red-300">
                + Seal
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="flex justify-between items-center mb-6">
            <nav class="space-x-4">
                <a href="{{ route('seal', ['filter' => 'all']) }}"
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'all' || !request('filter') ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    All
                </a>
                <a href="{{ route('seal', ['filter' => 'payment proccess']) }}"
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'payment proccess' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    Payment Proccess
                </a>
                <a href="{{ route('seal', ['filter' => 'success']) }}"
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'success' ? 'text-blue-600 underline' : 'text-gray-600 hover:text-gray-800' }}">
                    Success
                </a>
                <a href="{{ route('seal', ['filter' => 'failed']) }}"
                    class="px-3 py-2 text-sm font-medium {{ request('filter') === 'failed' ? 'text-red-600 underline' : 'text-gray-600 hover:text-red-800' }}">
                    Failed
                </a>
            </nav>
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

                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">
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
                                        'Payment Proccess' => 'bg-blue-100 text-blue-800 border-blue-200',
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
                                    <button type="button" data-seal-id="{{ $seal->id }}"
                                        onclick="getSnapToken({{ $seal->id }})"
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
        </div>
    </div>
    @push('script')
        <script>
            function getSnapToken(sealId) {
                // Get the button that was clicked using the data-seal-id attribute
                const button = document.querySelector(`button[data-seal-id="${sealId}"]`);

                // Disable the button
                if (button) {
                    button.disabled = true;
                }

                fetch(`/get-snap-token/${sealId}`, {
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
                                /* You will get notification from callback */
                                window.location.href = '/seal';
                            },
                            onPending: function(result) {
                                /* You will get notification from callback */
                                window.location.href = '/seal';
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal');
                                if (button) button.disabled = false;
                            },
                            onClose: function() {
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
