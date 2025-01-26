<div class="w-full max-w-3xl">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-teal-400 p-6">
            <h2 class="text-3xl font-bold text-white flex items-center">
                <i class="fas fa-shipping-fast mr-4"></i>
                Create Shipping Instructions
            </h2>
        </div>

        <form wire:submit.prevent="store" class="p-6 space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Shipment Dropdown --}}
                <div>
                    <label for="shipment_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>Select Shipment
                    </label>
                    <select 
                        wire:model.live="shipment_id" 
                        id="shipment_id" 
                        class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                    >
                        <option value="">Choose a Shipment</option>
                        @foreach($shipments as $shipment)
                            <option value="{{ $shipment->id }}">
                                {{ $shipment->vessel_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shipment_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Container Dropdown --}}
                @if($shipment_id)
                <div>
                    <label for="container_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-box-open mr-2 text-teal-500"></i>Select Container
                    </label>
                    <select 
                        wire:model.live="container_id" 
                        id="container_id" 
                        class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-300"
                    >
                        <option value="">Choose a Container</option>
                        @foreach($containers as $container)
                            <option value="{{ $container->id }}">
                                {{ $container->id_order }} - {{ $container->container_type }} (Qty: {{ $container->quantity }})
                            </option>
                        @endforeach
                    </select>
                    @error('container_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @endif
            </div>

            {{-- Container Details Inputs --}}
            @if($container_id && count($container_numbers) > 0)
                <div class="space-y-4">
                    @foreach(range(0, count($container_numbers) - 1) as $index)
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-truck mr-3 text-gray-600"></i>
                                <h3 class="text-lg font-semibold text-gray-700">Container {{ $index + 1 }}</h3>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="container_numbers.{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Container Number</label>
                                    <input 
                                        type="text" 
                                        wire:model="container_numbers.{{ $index }}" 
                                        id="container_numbers.{{ $index }}"
                                        class="block w-full px-3 py-2.5 border @error("container_numbers.{$index}") border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                    >
                                    @error("container_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="seal_numbers.{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Seal Number</label>
                                    <input 
                                        type="text" 
                                        wire:model="seal_numbers.{{ $index }}" 
                                        id="seal_numbers.{{ $index }}"
                                        class="block w-full px-3 py-2.5 border @error("seal_numbers.{$index}") border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                    >
                                    @error("seal_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="container_notes.{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                <textarea 
                                    wire:model="container_notes.{{ $index }}" 
                                    id="container_notes.{{ $index }}"
                                    rows="3"
                                    class="block w-full px-3 py-2.5 border @error("container_notes.{$index}") border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                ></textarea>
                                @error("container_notes.{$index}")
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-6">
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-teal-500 text-white py-3 px-4 rounded-lg hover:from-blue-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 flex items-center justify-center"
                >
                    <i class="fas fa-paper-plane mr-3"></i>
                    Create Shipping Instructions
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="m-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="m-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>