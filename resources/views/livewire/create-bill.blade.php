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

    {{-- Main Form Card --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Create New Bill</h1>
        </div>

        <div class="p-8">
            {{-- Selection Forms --}}
            <div class="grid grid-cols-1 gap-6 mb-8">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Company Name</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Select Company</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($user_id)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Shipment Details</label>
                        <select wire:model.live="shipment_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Select Shipment</option>
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">
                                    {{ $shipment->vessel_name }} ({{ $shipment->from_city }} → {{ $shipment->to_city }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($shipment_id)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Container Order ID</label>
                        <select wire:model.live="container_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Select Container</option>
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">{{ $container->id_order }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            @if ($selectedData)
                {{-- Bill Details Section --}}
                <div class="space-y-8">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Bill Details</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">Company Name</label>
                                <p class="text-gray-800">{{ $selectedData['company_name'] }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">Vessel Name</label>
                                <p class="text-gray-800">{{ $selectedData['vessel_name'] }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">Route</label>
                                <p class="text-gray-800">{{ $selectedData['route'] }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">Container Order ID</label>
                                <p class="text-gray-800">{{ $selectedData['id_order'] }}</p>
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
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Description
                                        </th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Base Rate
                                        </th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">
                                            Quantity/Weight</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Calculation
                                        </th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Shipping Rate</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                            {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                            {{ number_format($shipment->rate, 0, ',', '.') }} × 1</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                            {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Container Rate</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                            {{ number_format($selectedData['rate_per_container'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                            {{ $selectedData['quantity'] }} containers</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp
                                            {{ number_format($selectedData['rate_per_container'], 0, ',', '.') }} ×
                                            {{ $selectedData['quantity'] }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                            {{ number_format($selectedData['container_total_rate'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Weight-based Rate</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 90.000/100kg</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                            {{ number_format($selectedData['weight'], 0, ',', '.') }} kg</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 90.000 ×
                                            {{ ceil($selectedData['weight'] / 100) }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp
                                            {{ number_format($selectedData['weight_rate'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Document Fee</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 250.000</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp 250.000 × 1</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp 250.000
                                        </td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td colspan="4" class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                                            Total Amount</td>
                                        <td class="px-6 py-4 text-sm font-bold text-gray-900 text-center">Rp
                                            {{ number_format($selectedData['total_price'], 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end space-x-4 pt-6">
                        <button wire:click="createBill"
                            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Create Bill
                        </button>

                        @if ($status === 'Unpaid')
                            <button wire:click="payBill"
                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                                Pay Now
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
