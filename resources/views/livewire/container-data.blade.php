<div class="min-h-screen bg-gray-50 py-6 px-3 sm:px-8">
    <form wire:submit.prevent="addContainer" class="max-w-6xl mx-auto space-y-6">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hidden Fields -->
        <input type="hidden" wire:model="shipment_id" name="shipment_id" value="{{ $shipmentId }}">
        <input type="hidden" wire:model="user_id" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="is_danger" value="No">

        <!-- Shipment Information Section -->
        <div
            class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden transition-all hover:shadow-lg">
            <div class="border-b border-gray-200 bg-blue-600 px-6 py-4">
                <h1 class="text-xl font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Shipment Information
                </h1>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Stuffing Location</label>
                        <div class="flex rounded-md shadow-sm">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Indoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">
                                    Indoor
                                </span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Outdoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">
                                    Outdoor
                                </span>
                            </label>
                        </div>
                        @error('stuffing')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <input type="text"
                                class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-all"
                                wire:model="notes" placeholder="Add any additional notes">
                        </div>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Container Ownership</label>
                        <div class="flex rounded-md shadow-sm">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="ownership_container" name="ownership_container"
                                    value="COC" class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">COC</span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="ownership_container" name="ownership_container"
                                    value="SOC" class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">SOC</span>
                            </label>
                        </div>
                        @error('ownership_container')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Load Type</label>
                        <div class="flex rounded-md shadow-sm">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="load_type" name="load_type" value="Filled"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">
                                    Filled
                                </span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="load_type" name="load_type" value="Empty"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-4 py-3 bg-white border-2 border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full transition-all">
                                    Empty
                                </span>
                            </label>
                        </div>
                        @error('load_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Details Section -->
        <div
            class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden transition-all hover:shadow-lg">
            <div class="border-b border-gray-200 bg-blue-600 px-6 py-4">
                <h1 class="text-xl font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Container Details
                </h1>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Container Type</label>
                        <div class="relative">
                            <select wire:model="container_type" name="container_type"
                                class="appearance-none w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm pl-3 pr-10 py-3 transition-all">
                                <option value="" selected>Select Type</option>
                                <option value="40 Iso Tank">40 Iso Tank</option>
                                <option value="20 Iso Tank">20 Iso Tank</option>
                                <option value="20 Open Top">20 Open Top</option>
                                <option value="40 Open Top">40 Open Top</option>
                                <option value="45 Open Top">45 Open Top</option>
                                <option value="40 High Cube">40 High Cube</option>
                                <option value="45 High Cube">45 High Cube</option>
                                <option value="20 GP">20 GP</option>
                                <option value="40 GP">40 GP</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('container_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <div class="relative">
                            {{-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div> --}}
                            <input type="number" wire:model="quantity" min="1"
                                class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-all"
                                placeholder="Enter quantity">
                        </div>
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Commodity</label>
                        <div class="relative">
                            {{-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div> --}}
                            <input type="text" wire:model="commodity"
                                class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm uppercase transition-all"
                                placeholder="Enter commodity" autofocus>
                        </div>
                        @error('commodity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Weight (KG)</label>
                        <div class="relative rounded-md shadow-sm">
                            {{-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div> --}}
                            <input type="number" wire:model="weight"
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm pr-12 transition-all"
                                placeholder="Enter weight">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm font-medium">KG</span>
                            </div>
                        </div>
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Dangerous Goods Section -->
        <div
            class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden transition-all hover:shadow-lg">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-skull-crossbones text-2xl text-red-500"></i>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" wire:model="is_danger" id="is_danger"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-5 w-5 transition-colors"
                                value="Yes" @if ($is_danger === 'Yes') checked @endif>
                            <span class="text-base font-medium text-gray-800">This shipment contains dangerous
                                goods</span>
                        </label>
                        <p class="mt-2 text-sm text-gray-500 ml-7">Including explosives, flammable/toxic gases,
                            flammable
                            liquids, radioactive materials, toxic and infectious substances.</p>
                        @error('is_danger')
                            <p class="mt-1 text-sm text-red-600 ml-7">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:-translate-y-0.5">
                <span wire:loading.remove class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create New RO
                </span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </span>
            </button>
        </div>
    </form>
</div>
