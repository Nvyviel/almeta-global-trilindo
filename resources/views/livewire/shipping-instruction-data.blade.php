<div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6">
    <div class="bg-white overflow-hidden rounded-lg shadow-lg">
        {{-- Header Section --}}
        <div class="bg-blue-50 p-6 sm:p-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-blue-700 flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Create Shipping Instructions</span>
            </h2>
        </div>

        {{-- Selected Consignee Details --}}
        @if ($consignee_id)
            @php
                $selectedConsignee = $consignees->find($consignee_id);
            @endphp
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Consignee Details
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <p class="text-sm text-gray-500 mb-1">Industry</p>
                        <p class="font-medium text-gray-900">{{ $selectedConsignee->industry }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <p class="text-sm text-gray-500 mb-1">City</p>
                        <p class="font-medium text-gray-900">{{ $selectedConsignee->city }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-medium text-gray-900">{{ $selectedConsignee->email }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                        <p class="font-medium text-gray-900">{{ $selectedConsignee->phone_number }}</p>
                    </div>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 md:col-span-2 lg:col-span-3">
                        <p class="text-sm text-gray-500 mb-1">Address</p>
                        <p class="font-medium text-gray-900">{{ $selectedConsignee->consignee_address }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="store" class="p-6">
            <div class="grid lg:grid-cols-3 gap-6">
                {{-- Consignee Dropdown --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <label for="consignee_id" class="flex items-center gap-2 text-lg font-semibold text-gray-700 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Select Consignee
                    </label>
                    <select wire:model="consignee_id" id="consignee_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Choose a Consignee</option>
                        @foreach ($consignees as $consignee)
                            <option value="{{ $consignee->id }}">{{ $consignee->name_consignee }}</option>
                        @endforeach
                    </select>
                    @error('consignee_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Shipment Dropdown --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <label for="shipment_id" class="flex items-center gap-2 text-lg font-semibold text-gray-700 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 16a5 5 0 00-5-5h-4a5 5 0 00-5 5m14 0v2a3 3 0 01-3 3H8a3 3 0 01-3-3v-2m14 0V6a3 3 0 00-3-3H8a3 3 0 00-3 3v10" />
                        </svg>
                        Select Shipment
                    </label>
                    <select wire:model.live="shipment_id" id="shipment_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        <option value="">Choose a Shipment</option>
                        @foreach ($shipments as $shipment)
                            <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }}</option>
                        @endforeach
                    </select>
                    @error('shipment_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Container Dropdown --}}
                @if ($shipment_id)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <label for="container_id"
                            class="flex items-center gap-2 text-lg font-semibold text-gray-700 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Select Container
                        </label>
                        <select wire:model.live="container_id" id="container_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200">
                            <option value="">Choose a Container</option>
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">
                                    {{ $container->id_order }} - {{ $container->container_type }}
                                    ({{ $container->quantity }} Container)
                                </option>
                            @endforeach
                        </select>
                        @error('container_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>

            {{-- Container Details Section --}}
            @if ($container_id && count($container_numbers) > 0)
                <div class="space-y-6 mt-8">
                    @foreach (range(0, count($container_numbers) - 1) as $index)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 flex items-center justify-center bg-green-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Container {{ $index + 1 }}</h3>
                            </div>

                            <div class="grid lg:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Container
                                        Number</label>
                                    <input type="text" wire:model="container_numbers.{{ $index }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        placeholder="Enter container number">
                                    @error("container_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Seal Number</label>
                                    <input type="text" wire:model="seal_numbers.{{ $index }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        placeholder="Enter seal number">
                                    @error("seal_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                    <textarea wire:model="container_notes.{{ $index }}" rows="4"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        placeholder="Add any additional notes here"></textarea>
                                    @error("container_notes.{$index}")
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Submit Button --}}
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-blue-100 text-blue-700 py-3 px-6 rounded-lg hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center justify-center text-lg font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Create Shipping Instructions
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mx-6 mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-lg font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="mx-6 mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-lg font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
