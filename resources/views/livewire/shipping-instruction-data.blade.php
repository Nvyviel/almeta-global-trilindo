<div class="w-full bg-gray-50 min-h-screen py-8 px-4">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl overflow-hidden shadow-2xl">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8">
            <h2 class="text-4xl font-bold text-white flex items-center space-x-4">
                <i class="fas fa-file-alt"></i>
                <span>Create Shipping Instructions</span>
            </h2>
        </div>

        <form wire:submit.prevent="store" class="p-8 space-y-8">
            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Shipment Dropdown --}}
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <label for="shipment_id" class="block text-base font-semibold text-gray-800 mb-3">
                        <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Select Shipment
                    </label>
                    <select 
                        wire:model.live="shipment_id" 
                        id="shipment_id" 
                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                    >
                        <option value="">Choose a Shipment</option>
                        @foreach($shipments as $shipment)
                            <option value="{{ $shipment->id }}">
                                {{ $shipment->vessel_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shipment_id')
                        <p class="mt-3 text-sm text-red-500 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Container Dropdown --}}
                @if($shipment_id)
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <label for="container_id" class="block text-base font-semibold text-gray-800 mb-3">
                        <i class="fas fa-box-open text-purple-600 mr-2"></i>Select Container
                    </label>
                    <select 
                        wire:model.live="container_id" 
                        id="container_id" 
                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300"
                    >
                        <option value="">Choose a Container</option>
                        @foreach($containers as $container)
                            <option value="{{ $container->id }}">
                                {{ $container->id_order }} - {{ $container->container_type }} (Qty: {{ $container->quantity }})
                            </option>
                        @endforeach
                    </select>
                    @error('container_id')
                        <p class="mt-3 text-sm text-red-500 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @endif
            </div>

            {{-- Container Details Inputs --}}
            @if($container_id && count($container_numbers) > 0)
                <div class="space-y-6">
                    @foreach(range(0, count($container_numbers) - 1) as $index)
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 flex items-center justify-center bg-indigo-100 rounded-full mr-4">
                                    <i class="fas fa-truck text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Container {{ $index + 1 }}</h3>
                            </div>
                            
                            <div class="grid lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="container_numbers.{{ $index }}" class="block text-sm font-semibold text-gray-700 mb-2">Container Number</label>
                                    <input 
                                        type="text" 
                                        wire:model="container_numbers.{{ $index }}" 
                                        id="container_numbers.{{ $index }}"
                                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                    >
                                    @error("container_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="seal_numbers.{{ $index }}" class="block text-sm font-semibold text-gray-700 mb-2">Seal Number</label>
                                    <input 
                                        type="text" 
                                        wire:model="seal_numbers.{{ $index }}" 
                                        id="seal_numbers.{{ $index }}"
                                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                    >
                                    @error("seal_numbers.{$index}")
                                        <p class="mt-2 text-sm text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="container_notes.{{ $index }}" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                                <textarea 
                                    wire:model="container_notes.{{ $index }}" 
                                    id="container_notes.{{ $index }}"
                                    rows="3"
                                    class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                ></textarea>
                                @error("container_notes.{$index}")
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="pt-6">
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-6 rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 flex items-center justify-center text-lg font-semibold"
                >
                    <i class="fas fa-paper-plane mr-3"></i>
                    Create Shipping Instructions
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mx-8 mb-8 bg-green-50 border-l-4 border-green-500 text-green-700 p-5 rounded-xl" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-xl text-green-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="mx-8 mb-8 bg-red-50 border-l-4 border-red-500 text-red-700 p-5 rounded-xl" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-xl text-red-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>