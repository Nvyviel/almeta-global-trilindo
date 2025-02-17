<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-6 bg-transparent">
    {{-- Alert Messages --}}
    @if (session()->has('success'))
        <div class="transform transition-all duration-300 ease-in-out hover:scale-[1.02]">
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-sm"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="transform transition-all duration-300 ease-in-out hover:scale-[1.02]">
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Title Section --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Bills</h1>
        <p class="mt-2 text-sm text-gray-600">Generate and manage your shipping documents</p>
    </div>

    {{-- Selection Forms Card --}}
    <div
        class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Company Name</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200">
                        <option value="">Select Company</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($user_id)
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Shipment Details</label>
                        <select wire:model.live="shipment_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200">
                            <option value="">Select Shipment</option>
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }}
                                    ({{ $shipment->from_city }} → {{ $shipment->to_city }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($shipment_id)
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Container Order ID</label>
                        <select wire:model.live="container_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200">
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
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="border-b border-gray-200 bg-gray-50 px-8 py-4">
                <h2 class="text-xl font-semibold text-gray-900">Bill Details</h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Company Name</label>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $selectedData['company_name'] }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Route</label>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $selectedData['route'] }}</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Vessel Name</label>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $selectedData['vessel_name'] }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Container Order ID</label>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $selectedData['id_order'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Price Breakdown Card --}}
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="border-b border-gray-200 bg-gray-50 px-8 py-4">
                <h3 class="text-xl font-semibold text-gray-900">Price Breakdown</h3>
            </div>
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-left">Description</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Base Rate</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-center">Quantity/Weight
                                </th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Calculation</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-700">Shipping Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp
                                    {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp
                                    {{ number_format($shipment->rate, 0, ',', '.') }} × 1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Rp
                                    {{ number_format($shipment->rate, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-700">Container Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp
                                    {{ number_format($selectedData['rate_per_container'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $selectedData['quantity'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp
                                    {{ number_format($selectedData['rate_per_container'], 0, ',', '.') }} ×
                                    {{ $selectedData['quantity'] }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Rp
                                    {{ number_format($selectedData['container_total_rate'], 0, ',', '.') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-700">Weight Rate</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp 90.000 per 100kg</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ ceil($selectedData['weight'] / 100) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp 90.000 ×
                                    {{ ceil($selectedData['weight'] / 100) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Rp
                                    {{ number_format($selectedData['weight_rate'], 0, ',', '.') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-700">Document Fee</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp 250.000</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-right">Rp 250.000 × 1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">Rp 250.000</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td colspan="4" class="px-6 py-4 text-sm font-semibold text-gray-900">Grand Total
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">Rp
                                    {{ number_format($selectedData['total_price'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="border-b border-gray-200 bg-gray-50 px-8 py-4">
                <h3 class="text-xl font-semibold text-gray-900">Upload Documents</h3>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    <div x-data="{ fileChosen: false }" class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Upload Supporting Document
                        </label>
                        <div class="mt-1 flex items-center space-x-4">
                            <div class="flex-1">
                                <label
                                    class="flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200 @error('uploadFile') border-red-500 @enderror">
                                    <input type="file" wire:model="uploadFile" class="sr-only"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Choose file or drag and drop</span>
                                </label>
                            </div>
                        </div>
                        <div wire:loading wire:target="uploadFile" class="text-sm text-indigo-600">
                            Uploading...
                        </div>
                        @error('uploadFile')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if ($uploadFile)
                            <p class="text-sm text-gray-500">File selected: {{ $uploadFile->getClientOriginalName() }}
                            </p>
                        @endif
                        <p class="text-xs text-gray-500">
                            Accepted file types: Only PDF (max. 10MB)
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Action Buttons Card --}}
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="p-8 flex justify-end space-x-4">
                <button wire:click="createBill"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Bill
                </button>
            </div>
        </div>
    @endif
</div>
