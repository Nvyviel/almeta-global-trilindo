<div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-2xl rounded-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-10">
                <h2 class="text-5xl font-bold text-white flex items-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
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
                <div class="p-8 bg-gray-50 border-b border-gray-200">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6">Consignee Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition">
                            <p class="text-sm text-gray-600">Industry</p>
                            <p class="font-medium text-gray-900">{{ $selectedConsignee->industry }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition">
                            <p class="text-sm text-gray-600">City</p>
                            <p class="font-medium text-gray-900">{{ $selectedConsignee->city }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition">
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium text-gray-900">{{ $selectedConsignee->email }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition">
                            <p class="text-sm text-gray-600">Phone Number</p>
                            <p class="font-medium text-gray-900">{{ $selectedConsignee->phone_number }}</p>
                        </div>
                        <div
                            class="bg-white p-4 rounded-xl md:col-span-2 lg:col-span-3 shadow-md hover:shadow-lg transition">
                            <p class="text-sm text-gray-600">Address</p>
                            <p class="font-medium text-gray-900">{{ $selectedConsignee->consignee_address }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form wire:submit.prevent="store" class="p-10 space-y-10">
                <div class="grid lg:grid-cols-3 gap-10">
                    {{-- Consignee Dropdown --}}
                    <div
                        class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100 shadow-sm">
                        <label for="consignee_id" class="block text-lg font-semibold text-blue-800 mb-4">
                            Select Consignee
                        </label>
                        <select wire:model="consignee_id" id="consignee_id"
                            class="block w-full px-5 py-3 bg-white border border-blue-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            <option value="">Choose a Consignee</option>
                            @foreach ($consignees as $consignee)
                                <option value="{{ $consignee->id }}">{{ $consignee->name_consignee }}</option>
                            @endforeach
                        </select>
                        @error('consignee_id')
                            <p class="mt-3 text-sm text-red-600 flex items-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Shipment Dropdown --}}
                    <div
                        class="bg-gradient-to-r from-indigo-50 to-purple-50 p-8 rounded-2xl border border-indigo-100 shadow-sm">
                        <label for="shipment_id" class="block text-lg font-semibold text-indigo-800 mb-4">
                            Select Shipment
                        </label>
                        <select wire:model.live="shipment_id" id="shipment_id"
                            class="block w-full px-5 py-3 bg-white border border-indigo-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                            <option value="">Choose a Shipment</option>
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }}</option>
                            @endforeach
                        </select>
                        @error('shipment_id')
                            <p class="mt-3 text-sm text-red-600 flex items-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Container Dropdown --}}
                    @if ($shipment_id)
                        <div
                            class="bg-gradient-to-r from-purple-50 to-indigo-50 p-8 rounded-2xl border border-purple-100 shadow-sm">
                            <label for="container_id" class="block text-lg font-semibold text-purple-800 mb-4">
                                Select Container
                            </label>
                            <select wire:model.live="container_id" id="container_id"
                                class="block w-full px-5 py-3 bg-white border border-purple-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300">
                                <option value="">Choose a Container</option>
                                @foreach ($containers as $container)
                                    <option value="{{ $container->id }}">
                                        {{ $container->id_order }} - {{ $container->container_type }}
                                        ({{ $container->quantity }} Container)
                                    </option>
                                @endforeach
                            </select>
                            @error('container_id')
                                <p class="mt-3 text-sm text-red-600 flex items-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @endif
                </div>

                {{-- Container Details Inputs --}}
                @if ($container_id && count($container_numbers) > 0)
                    <div class="space-y-8">
                        @foreach (range(0, count($container_numbers) - 1) as $index)
                            <div
                                class="bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-2xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center bg-indigo-100 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800">Container {{ $index + 1 }}</h3>
                                </div>

                                <div class="grid lg:grid-cols-2 gap-8">
                                    <div>
                                        <label for="container_numbers.{{ $index }}"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Container Number
                                        </label>
                                        <input type="text" wire:model="container_numbers.{{ $index }}"
                                            id="container_numbers.{{ $index }}"
                                            class="block w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                            placeholder="Enter container number">
                                        @error("container_numbers.{$index}")
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="seal_numbers.{{ $index }}"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Seal Number
                                        </label>
                                        <input type="text" wire:model="seal_numbers.{{ $index }}"
                                            id="seal_numbers.{{ $index }}"
                                            class="block w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                            placeholder="Enter seal number">
                                        @error("seal_numbers.{$index}")
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label for="container_notes.{{ $index }}"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Notes
                                        </label>
                                        <textarea wire:model="container_notes.{{ $index }}" id="container_notes.{{ $index }}" rows="4"
                                            class="block w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                            placeholder="Add any additional notes here"></textarea>
                                        @error("container_notes.{$index}")
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Submit Button --}}
                <div class="pt-10">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-5 px-8 rounded-2xl hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 flex items-center justify-center text-xl font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Create Shipping Instructions
                    </button>
                </div>
            </form>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mx-10 mb-10 bg-green-50 border-l-4 border-green-600 text-green-800 p-6 rounded-2xl shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-lg font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="mx-10 mb-10 bg-red-50 border-l-4 border-red-600 text-red-800 p-6 rounded-2xl shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-lg font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
