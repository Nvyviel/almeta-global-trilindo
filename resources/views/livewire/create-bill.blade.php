<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-4">
    {{-- Alert Messages --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm transition-all duration-500 ease-in-out" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Title Card --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Bill</h1>
        </div>
    </div>

    {{-- Selection Forms Card --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">
        <div class="p-6 space-y-6">
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Company Name</label>
                    <select wire:model.live="user_id" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        <option value="">Select Company</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($user_id)
                    <div>
                        <label class="text-sm font-medium text-gray-700">Shipment Details</label>
                        <select wire:model.live="shipment_id" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            <option value="">Select Shipment</option>
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }} ({{ $shipment->from_city }} → {{ $shipment->to_city }})</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($shipment_id)
                    <div>
                        <label class="text-sm font-medium text-gray-700">Container Order ID</label>
                        <select wire:model.live="container_id" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            <option value="">Select Container</option>
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">{{ $container->id_order }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($selectedData)
        {{-- Bill Details Card --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Bill Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Company Name</label>
                        <p class="mt-1 text-gray-800">{{ $selectedData['company_name'] }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Vessel Name</label>
                        <p class="mt-1 text-gray-800">{{ $selectedData['vessel_name'] }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Route</label>
                        <p class="mt-1 text-gray-800">{{ $selectedData['route'] }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Container Order ID</label>
                        <p class="mt-1 text-gray-800">{{ $selectedData['id_order'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Price Breakdown Card --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Price Breakdown</h3>
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
                            {{-- Table rows remain the same --}}
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Shipping Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">Rp {{ number_format($shipment->rate, 0, ',', '.') }} × 1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-center">Rp {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                            </tr>
                            {{-- Add other rows similarly --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Action Buttons Card --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="p-6 flex justify-end space-x-4">
                <button wire:click="createBill" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                    Create Bill
                </button>

                @if ($status === 'Unpaid')
                    <button wire:click="payBill" class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        Pay Now
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>