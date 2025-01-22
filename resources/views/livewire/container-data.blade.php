<div class="flex">
    <form wire:submit.prevent="addContainer">
        <div class="p-8 w-full bg-white shadow-lg rounded-lg">
            <!-- Form Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-semibold text-blue-800">Shipment Data</h1>
                <hr class="my-4 border-t-2 border-blue-500">
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Stuffing Section -->
                <div>
                    <h2 class="text-lg mb-4 font-semibold text-blue-700">Stuffing</h2>
                    <div class="flex">
                        <label class="radio-btn">
                            <input type="radio" wire:model="stuffing" name="stuffing" value="Indoor" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-l-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">Indoor</span>
                        </label>
                        <label class="radio-btn">
                            <input type="radio" wire:model="stuffing" name="stuffing" value="Outdoor" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-r-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">Outdoor</span>
                        </label>
                    </div>
                </div>

                {{-- Hidden Input --}}
                <input type="hidden" wire:model="shipment_id" name="shipment_id" value="{{ $shipmentId }}">
                <input type="hidden" wire:model="user_id" name="user_id" value="{{ $userId }}">

                <!-- Note Section -->
                <div>
                    <h2 class="text-lg font-semibold text-blue-700">Note</h2>
                    <input type="text" class="w-full mt-2 p-3 border border-gray-300 rounded-md" wire:model="notes" placeholder="Note (Optional)">
                </div>

                <!-- Ownership Container -->
                <div>
                    <h2 class="text-lg mb-4 font-semibold text-blue-700">Ownership Container</h2>
                    <div class="flex">
                        <label class="radio-btn">
                            <input type="radio" wire:model="ownership_container" name="ownership_container" value="COC" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-l-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">COC</span>
                        </label>
                        <label class="radio-btn">
                            <input type="radio" wire:model="ownership_container" name="ownership_container" value="SOC" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-r-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">SOC</span>
                        </label>
                    </div>
                </div>

                <!-- Load Type Section -->
                <div>
                    <h2 class="text-lg mb-2 font-semibold text-blue-700">Load Type</h2>
                    <div class="flex">
                        <label class="radio-btn">
                            <input type="radio" wire:model="load_type" name="load_type" value="Filled" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-l-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">Filled</span>
                        </label>
                        <label class="radio-btn">
                            <input type="radio" wire:model="load_type" name="load_type" value="Empty" class="hidden peer">
                            <span class="btn peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 rounded-r-md px-4 py-2 cursor-pointer hover:bg-blue-100 w-full text-center">Empty</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Data Section -->
        <div class="p-8 w-full bg-white shadow-lg rounded-lg mt-10">
            <div class="mb-6">
                <h1 class="text-3xl font-semibold text-blue-800">Container Data</h1>
                <hr class="my-4 border-t-2 border-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-6">
                <!-- Container Type -->
                <div>
                    <h2 class="text-lg mb-2 font-semibold text-blue-700">Container Type</h2>
                    <select wire:model="container_type" name="container_type" class="w-full p-3 border border-gray-300 rounded-md">
                        <option value="" selected>Select Container Type</option>
                        <option value="40 Open Door">40 Open Door</option>
                        <option value="20 Open Door">20 Open Door</option>
                        <option value="40 Flat Rack">40 Flat Rack</option>
                        <option value="20 Flat Rack">20 Flat Rack</option>
                        <option value="40 Iso Tank">40 Iso Tank</option>
                        <option value="20 Iso Tank">20 Iso Tank</option>
                        <option value="20 Open Top">20 Open Top</option>
                        <option value="40 Open Top">40 Open Top</option>
                        <option value="20 Motorcycle Rack">20 Motorcycle Rack</option>
                        <option value="45 Open Top">45 Open Top</option>
                        <option value="20 Container Office">20 Container Office</option>
                        <option value="40 RF High Cube">40 RF High Cube</option>
                        <option value="20 RF High Cube">20 RF High Cube</option>
                        <option value="40 High Cube">40 High Cube</option>
                        <option value="45 High Cube">45 High Cube</option>
                        <option value="20 GP">20 GP</option>
                        <option value="21 GP">21 GP</option>
                        <option value="40 GP">40 GP</option>
                        <option value="41 GP">41 GP</option>
                    </select>
                </div>

                <!-- Quantity Input -->
                <div>
                    <h2 class="text-lg mb-2 font-semibold text-blue-700">Quantity</h2>
                    <input type="number" class="w-full p-3 border border-gray-300 rounded-md" wire:model="quantity" min="1" placeholder="Enter quantity">
                </div>

                <!-- Commodity Input -->
                <div>
                    <h2 class="text-lg mb-2 font-semibold text-blue-700">Commodity</h2>
                    <input type="text" class="w-full p-3 border border-gray-300 rounded-md" wire:model="commodity" placeholder="Enter commodity" autofocus oninput="this.value = this.value.toUpperCase()">
                </div>

                <!-- Weight Input -->
                <div class="relative">
                    <h2 class="text-lg mb-2 font-semibold text-blue-700">Weight</h2>
                    <div class="flex items-center">
                        <input type="number" class="w-full p-3 border border-gray-300 rounded-md pr-16" wire:model="weight" placeholder="Enter weight">
                        <span class="absolute right-3 text-gray-600">KG</span>
                    </div>
                </div>
            </div>

            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
        </div>

        <div class="p-8 w-full bg-white shadow-lg rounded-lg mt-10">

            <!-- Is Danger -->
            <div>
                <h2 class="text-lg mb-2 font-semibold text-blue-700">Dangerous product Confirmation</h2>
                <div class="flex items-center">
                    <input type="checkbox" wire:model="is_danger" id="is_danger" class="mr-2" 
                        value="Yes" 
                        @if($is_danger === 'Yes') checked @endif>
                    <label for="is_danger" class="cursor-pointer text-gray-600"><i class="fa-solid fa-skull-crossbones text-5xl mx-4 my-3 text-red-600"></i> Yes, including explosives, flammable / toxic gases, flammable liquids, radioactive materials, toxic and infectious substances.</label>
                </div>
                <input type="hidden" name="is_danger" value="No">
            </div>
            <!-- Submit Button -->
            <div x-data="{ loading: false }" 
                @container-created.window="loading = false"
                class="mt-6">
                <button 
                    wire:click="addContainer"
                    @click="loading = true" 
                    :disabled="loading" 
                    class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!loading">Create New RO</span>
                    <span x-show="loading" class="animate-pulse">Processing...</span>
                </button>
            </div>
        </div>
    </form>
</div>
