<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Create Shipment Form Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-12 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-blue-500 p-6">
                <h1 class="text-3xl md:text-4xl font-bold text-white text-center">Create Shipment Schedule</h1>
            </div>

            <div class="p-6 md:p-8">
                <!-- Success Message -->
                @if (session()->has('success'))
                <div class="p-4 mb-6 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-200">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Error Message -->
                @if (session()->has('error'))
                <div class="p-4 mb-6 text-sm text-rose-700 bg-rose-50 rounded-xl border border-rose-200">
                    {{ session('error') }}
                </div>
                @endif

                <form wire:submit.prevent="addSchedule" class="space-y-6">
                    <div class="space-y-6">
                        <!-- Vessel Name -->
                        <div class="w-full">
                            <label for="vessel_name" class="block text-gray-700 font-medium mb-2">Vessel Name</label>
                            <input 
                                type="text" 
                                wire:model.defer="vessel_name" 
                                id="vessel_name" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('vessel_name') border-red-300 @enderror" 
                                placeholder="Enter vessel name"
                                style="text-transform: uppercase;"
                                autofocus>
                            @error('vessel_name') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Rate -->
                        <div class="w-full">
                            <label for="rate" class="block text-gray-700 font-medium mb-2">Rate per Container (IDR)</label>
                            <input 
                                type="number" 
                                wire:model.defer="rate" 
                                id="rate" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('rate') border-red-300 @enderror" 
                                placeholder="Enter rate per container">
                            @error('rate') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Grid for date inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Closing Cargo -->
                            <div>
                                <label for="closing_cargo" class="block text-gray-700 font-medium mb-2">Closing Cargo</label>
                                <input 
                                    type="datetime-local" 
                                    wire:model.defer="closing_cargo" 
                                    id="closing_cargo" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('closing_cargo') border-red-300 @enderror">
                                @error('closing_cargo') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- ETB -->
                            <div>
                                <label for="etb" class="block text-gray-700 font-medium mb-2">ETB</label>
                                <input 
                                    type="datetime-local" 
                                    wire:model.defer="etb" 
                                    id="etb" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('etb') border-red-300 @enderror">
                                @error('etb') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- ETD -->
                            <div>
                                <label for="etd" class="block text-gray-700 font-medium mb-2">ETD</label>
                                <input 
                                    type="datetime-local" 
                                    wire:model.defer="etd" 
                                    id="etd" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('etd') border-red-300 @enderror">
                                @error('etd') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- ETA -->
                            <div>
                                <label for="eta" class="block text-gray-700 font-medium mb-2">ETA</label>
                                <input 
                                    type="datetime-local" 
                                    wire:model.defer="eta" 
                                    id="eta" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('eta') border-red-300 @enderror">
                                @error('eta') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Ports Selection -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- POL -->
                            <div>
                                <label for="from_city" class="block text-gray-700 font-medium mb-2">Port of Loading (POL)</label>
                                <select 
                                    wire:model.defer="from_city" 
                                    id="from_city"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('from_city') border-red-300 @enderror">
                                    <option value="">Select Port of Loading</option>
                                    @foreach($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                                @error('from_city') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- POD -->
                            <div>
                                <label for="to_city" class="block text-gray-700 font-medium mb-2">Port of Discharge (POD)</label>
                                <select 
                                    wire:model.defer="to_city" 
                                    id="to_city"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all @error('to_city') border-red-300 @enderror">
                                    <option value="">Select Port of Discharge</option>
                                    @foreach($cities as $city)
                                        <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                    @endforeach
                                </select>
                                @error('to_city') <span class="text-rose-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 text-center">
                            <button 
                                type="submit" 
                                class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-purple-200 transition-all duration-300"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed">
                                <span wire:loading.remove>Create Shipment</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shipments List Section -->
        <div class="mt-12">
            <div class="bg-gradient-to-r from-purple-600 to-blue-500 p-6 rounded-2xl mb-8">
                <h1 class="text-3xl font-bold text-white text-center">Shipments List</h1>
            </div>

            @if($shipments->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                    @foreach ($shipments as $shipment)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="bg-gray-50 p-6 border-b border-gray-100">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <h2 class="text-2xl font-bold text-gray-800">{{ $shipment->vessel_name }}</h2>
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        <div class="flex items-center space-x-2 text-lg font-medium text-gray-600">
                                            <span>{{ strtoupper($shipment->from_city) }}</span>
                                            <span class="text-purple-500">&rarr;</span>
                                            <span>{{ strtoupper($shipment->to_city) }}</span>
                                        </div>
                                        <div class="inline-flex">
                                            <span class="bg-purple-50 text-purple-700 text-sm font-medium px-4 py-2 rounded-lg">
                                                Rp. {{ number_format($shipment->rate, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Closing Cargo</p>
                                            <p class="text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">ETB</p>
                                            <p class="text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">ETD</p>
                                            <p class="text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">ETA</p>
                                            <p class="text-gray-800">
                                                {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <a 
                                        href="{{ route('edit-shipment', $shipment->id) }}" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-xl transition-colors duration-200 text-center">
                                        Edit
                                    </a>
                                    <button 
                                        wire:click="deleteShipment({{ $shipment->id }})" 
                                        wire:confirm="Are you sure you want to delete this shipment?"
                                        class="bg-rose-500 hover:bg-rose-600 text-white font-medium py-3 px-4 rounded-xl transition-colors duration-200">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <p class="text-2xl font-semibold text-gray-400">No shipments available!</p>
                </div>
            @endif
        </div>
    </div>
</div>