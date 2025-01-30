<div class="mx-auto px-4 min-h-screen">
    <!-- Create Shipment Form Section -->
    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl border border-gray-200 mb-12">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-8 text-gray-900 text-center">Create Shipment Schedule</h1>

        <!-- Success Message -->
        @if (session()->has('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Message -->
        @if (session()->has('error'))
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg border-l-4 border-red-500">
            {{ session('error') }}
        </div>
        @endif

        <form wire:submit.prevent="addSchedule" class="space-y-8">
            <div class="space-y-6">
                <!-- Vessel Name -->
                <div class="w-full">
                    <label for="vessel_name" class="block text-gray-700 font-semibold mb-2">Vessel Name</label>
                    <input 
                        type="text" 
                        wire:model.defer="vessel_name" 
                        id="vessel_name" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('vessel_name') border-red-500 @enderror" 
                        placeholder="Enter vessel name"
                        style="text-transform: uppercase;"
                        autofocus>
                    @error('vessel_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Grid for date inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Closing Cargo -->
                    <div>
                        <label for="closing_cargo" class="block text-gray-700 font-semibold mb-2">Closing Cargo</label>
                        <input 
                            type="datetime-local" 
                            wire:model.defer="closing_cargo" 
                            id="closing_cargo" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('closing_cargo') border-red-500 @enderror">
                        @error('closing_cargo') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- ETB -->
                    <div>
                        <label for="etb" class="block text-gray-700 font-semibold mb-2">ETB</label>
                        <input 
                            type="datetime-local" 
                            wire:model.defer="etb" 
                            id="etb" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('etb') border-red-500 @enderror">
                        @error('etb') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- ETD -->
                    <div>
                        <label for="etd" class="block text-gray-700 font-semibold mb-2">ETD</label>
                        <input 
                            type="datetime-local" 
                            wire:model.defer="etd" 
                            id="etd" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('etd') border-red-500 @enderror">
                        @error('etd') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- ETA -->
                    <div>
                        <label for="eta" class="block text-gray-700 font-semibold mb-2">ETA</label>
                        <input 
                            type="datetime-local" 
                            wire:model.defer="eta" 
                            id="eta" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('eta') border-red-500 @enderror">
                        @error('eta') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- POL -->
                    <div>
                        <label for="from_city" class="block text-gray-700 font-semibold mb-2">Port of Loading (POL)</label>
                        <select 
                            wire:model.defer="from_city" 
                            id="from_city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('from_city') border-red-500 @enderror">
                            <option value="">Select Port of Loading</option>
                            @foreach($cities as $city)
                                <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                            @endforeach
                        </select>
                        @error('from_city') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- POD -->
                    <div>
                        <label for="to_city" class="block text-gray-700 font-semibold mb-2">Port of Discharge (POD)</label>
                        <select 
                            wire:model.defer="to_city" 
                            id="to_city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('to_city') border-red-500 @enderror">
                            <option value="">Select Port of Discharge</option>
                            @foreach($cities as $city)
                                <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                            @endforeach
                        </select>
                        @error('to_city') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 text-center">
                    <button 
                        type="submit" 
                        class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-lg hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-300"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed">
                        <span wire:loading.remove>Create Shipment</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Shipments List Section -->
    <div class="mt-12">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-900 text-center">Shipments List</h1>

        @if($shipments->count() > 0)
            <div class="space-y-6">
                @foreach ($shipments as $shipment)
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 hover:shadow-xl transition-shadow duration-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">{{ $shipment->vessel_name }}</h2>
                            <div class="flex items-center space-x-2 text-lg font-medium text-gray-600">
                                <span>{{ strtoupper($shipment->from_city) }} </span>
                                <span class="text-indigo-500">&rarr;</span>
                                <span>{{ strtoupper($shipment->to_city) }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-semibold">Closing Cargo:</span><br>
                                    {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y, H:i') }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-semibold">ETB:</span><br>
                                    {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-semibold">ETD:</span><br>
                                    {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y, H:i') }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-semibold">ETA:</span><br>
                                    {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <a href="{{ route('edit-shipment', $shipment->id) }}" 
                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-center">
                                Edit
                            </a>
                            <button 
                                wire:click="deleteShipment({{ $shipment->id }})" 
                                wire:confirm="Are you sure you want to delete this shipment?" 
                                class="flex-1 bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-xl font-semibold text-gray-600 bg-white p-8 rounded-lg shadow-lg">
                Shipment list is empty!
            </div>
        @endif
    </div>
</div>
