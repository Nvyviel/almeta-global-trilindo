@extends('layouts.fullscreen')

@section('title', 'Detail')
@section('component')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('list-bill') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Bills
            </a>
        </div>

        {{-- Bill Details Section --}}
        <div class="space-y-8">
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Bill Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Bill ID</label>
                        <p class="text-gray-800 font-semibold">{{ $bill->bill_id }}</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Status</label>
                        <p class="text-gray-800 font-semibold">
                            <span
                                class="px-3 py-1 rounded-full text-sm 
                                @if ($bill->status === 'Unpaid') bg-yellow-100 text-yellow-800 
                                @elseif($bill->status === 'Paid') bg-green-100 text-green-800 
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $bill->status }}
                            </span>
                        </p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Company Name</label>
                        <p class="text-gray-800">{{ $bill->user->company_name }}</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Vessel Name</label>
                        <p class="text-gray-800">{{ $bill->shipment->vessel_name }}</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Route</label>
                        <p class="text-gray-800">{{ strtoupper($bill->shipment->from_city) }} →
                            {{ strtoupper($bill->shipment->to_city) }}</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Container Order ID</label>
                        <p class="text-gray-800">{{ $bill->container->id_order }}</p>
                    </div>
                </div>
            </div>

            {{-- Price Breakdown --}}
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Price Breakdown</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Description</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Base Rate</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Quantity/Weight</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Calculation</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Shipping Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                    {{ number_format($bill->shipment->rate, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                    {{ number_format($bill->shipment->rate, 0, ',', '.') }} × 1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                    {{ number_format($bill->shipment->rate, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Container Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                    {{ number_format($bill->container->rate_per_container, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $bill->container->quantity }}
                                    containers</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                    {{ number_format($bill->container->rate_per_container, 0, ',', '.') }} ×
                                    {{ $bill->container->quantity }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                    {{ number_format($bill->container->rate_per_container * $bill->container->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Weight-based Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 90.000/100kg</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ number_format($bill->container->weight, 0, ',', '.') }} kg</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 90.000 ×
                                    {{ ceil($bill->container->weight / 100) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                    {{ number_format(ceil($bill->container->weight / 100) * 90000, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Document Fee</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 250.000</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 250.000 × 1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp 250.000</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td colspan="4" class="px-6 py-4 text-sm font-bold text-gray-900 text-right">Total Amount
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 text-center">Rp
                                    {{ number_format($bill->grand_total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Action Button --}}
            @if ($bill->status === 'Unpaid')
                <div class="flex justify-end pt-6">
                    <button wire:click="payBill"
                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        Pay Now
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection
