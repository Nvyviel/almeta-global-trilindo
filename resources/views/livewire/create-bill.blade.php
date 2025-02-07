{{-- resources/views/livewire/create-bill.blade.php --}}
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    {{-- Alert Messages --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form Section --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Company Name</label>
            <select wire:model.live="user_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select Company</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                @endforeach
            </select>
        </div>

        @if ($user_id)
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Shipment Details</label>
                <select wire:model.live="shipment_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Shipment</option>
                    @foreach ($shipments as $shipment)
                        <option value="{{ $shipment->id }}">
                            {{ $shipment->vessel_name }} ({{ $shipment->from_city }} -> {{ $shipment->to_city }})
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if ($shipment_id)
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Container Order ID</label>
                <select wire:model.live="container_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Container</option>
                    @foreach ($containers as $container)
                        <option value="{{ $container->id }}">{{ $container->id_order }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if ($selectedData)
            {{-- Bill Details Section --}}
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6">Bill Details</h2>

                <table class="min-w-full border-collapse table-auto">
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left font-semibold">Company Name</td>
                            <td class="py-3 px-6">{{ $selectedData['company_name'] }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left font-semibold">Vessel Name</td>
                            <td class="py-3 px-6">{{ $selectedData['vessel_name'] }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left font-semibold">Route</td>
                            <td class="py-3 px-6">{{ $selectedData['route'] }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left font-semibold">Container Order ID</td>
                            <td class="py-3 px-6">{{ $selectedData['id_order'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Price Breakdown</h3>
                    <table class="min-w-full border-collapse table-auto">
                        <tbody class="bg-white">
                            <tr class="border-b">
                                <td class="py-3 px-6 text-left">Shipping Rate</td>
                                <td class="py-3 px-6 text-right">Rp {{ number_format($shipment->rate, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-6 text-left">Container Rate (Rp {{ number_format($selectedData['rate_per_container'], 0, ',', '.') }} × {{ $selectedData['quantity'] }} containers)</td>
                                <td class="py-3 px-6 text-right">Rp {{ number_format($selectedData['container_total_rate'], 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-6 text-left">Document Fee</td>
                                <td class="py-3 px-6 text-right">Rp {{ number_format(250000, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="py-3 px-6 text-left font-bold">Total Amount</td>
                                <td class="py-3 px-6 text-right font-bold">Rp {{ number_format($selectedData['total_price'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button wire:click="createBill"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Bill
                    </button>

                    @if ($status === 'Unpaid')
                        <button wire:click="payBill"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Pay Now
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
