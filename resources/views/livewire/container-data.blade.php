<div class="min-h-screen bg-gray-50 py-4 sm:py-8 px-2 sm:px-6 lg:px-8">
    <form wire:submit.prevent="addContainer" class="max-w-7xl mx-auto space-y-4 sm:space-y-6">
        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-3 sm:p-4">
                <div class="flex flex-col sm:flex-row">
                    <div class="flex-shrink-0 mb-2 sm:mb-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="sm:ml-3">
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

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-200 bg-gray-50 px-4 sm:px-6 py-3 sm:py-4">
                <h1 class="text-lg sm:text-xl font-semibold text-gray-900">Shipment Information</h1>
            </div>
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Stuffing Location</label>
                        <div class="flex rounded-md shadow-sm">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Indoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">Indoor</span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Outdoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">Outdoor</span>
                            </label>
                        </div>
                        @error('stuffing')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" wire:model="shipment_id" name="shipment_id" value="{{ $shipmentId }}">
                    <input type="hidden" wire:model="user_id" name="user_id" value="{{ $userId }}">

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <input type="text"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            wire:model="notes" placeholder="Add any additional notes">
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
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">COC</span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="ownership_container" name="ownership_container"
                                    value="SOC" class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">SOC</span>
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
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-gray-300 text-sm font-medium rounded-l-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">Filled</span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="load_type" name="load_type" value="Empty"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-2 sm:px-4 py-2 sm:py-2.5 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r-md peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50 cursor-pointer w-full">Empty</span>
                            </label>
                        </div>
                        @error('load_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-200 bg-gray-50 px-4 sm:px-6 py-3 sm:py-4">
                <h1 class="text-lg sm:text-xl font-semibold text-gray-900">Container Details</h1>
            </div>
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Container Type</label>
                        <select wire:model="container_type" name="container_type"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
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
                        @error('container_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" wire:model="quantity" min="1"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Enter quantity">
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Commodity</label>
                        <input type="text" wire:model="commodity"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm uppercase"
                            placeholder="Enter commodity" autofocus>
                        @error('commodity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Weight (KG)</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" wire:model="weight"
                                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm pr-12"
                                placeholder="Enter weight">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm">KG</span>
                            </div>
                        </div>
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-skull-crossbones text-3xl sm:text-4xl text-red-500"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <label class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                            <input type="checkbox" wire:model="is_danger" id="is_danger"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-4 w-4"
                                value="Yes" @if ($is_danger === 'Yes') checked @endif>
                            <span>This shipment contains dangerous goods</span>
                        </label>
                        <p class="mt-1 text-sm text-gray-500">Including explosives, flammable/toxic gases, flammable
                            liquids, radioactive materials, toxic and infectious substances.</p>
                        @error('is_danger')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="is_danger" value="No">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove>Create New RO</span>
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
