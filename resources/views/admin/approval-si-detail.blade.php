@extends('layouts.main')

@section('title','Detail')
@section('component')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h4 class="text-xl font-semibold text-gray-800">
                        {{ $dataSi->container->id_order }}
                    </h4>
                    <div class="flex items-center space-x-3">
                        <!-- Back Button -->
                        <a href="{{ route('approval-si') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <!-- Container Info -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <h5 class="font-semibold mb-2">Container Information</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <p><span class="font-medium">Vessel Name:</span>
                            {{ $dataSi->container->shipment_container->vessel_name }}</p>
                        <p><span class="font-medium">Container Type:</span> {{ $dataSi->container->container_type }}</p>
                        <p><span class="font-medium">Quantity:</span> {{ $dataSi->container->quantity }}</p>
                    </div>
                </div>

                <!-- Shipping Instructions Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Container Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Seal Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Note</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($dataSi->container->shippingInstructions as $instruction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $instruction->instructions_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $instruction->no_container }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $instruction->no_seal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $instruction->note ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $instruction->status === 'Approved'
                                            ? 'bg-green-100 text-green-800'
                                            : ($instruction->status === 'Rejected'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $instruction->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No shipping instructions available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
