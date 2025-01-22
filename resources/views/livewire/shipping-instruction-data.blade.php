<div>
    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-4">
            @if (session('message-type') === 'success')
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                    {{ session('message') }}
                </div>
            @else
                <div class="p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-6">
        <!-- Container Selection -->
        <div>
            <label for="container_id" class="block text-sm font-medium text-gray-700">Container</label>
            <select
                wire:model="container_id"
                id="container_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">Select Container</option>
                @foreach($containers as $container)
                    <option value="{{ $container->id }}">{{ $container->container_id }}</option>
                @endforeach
            </select>
            @error('container_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Container Number -->
        <div>
            <label for="no_container" class="block text-sm font-medium text-gray-700">Container Number</label>
            <input
                type="text"
                wire:model="no_container"
                id="no_container"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter container number"
            >
            @error('no_container') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Seal Number -->
        <div>
            <label for="no_seal" class="block text-sm font-medium text-gray-700">Seal Number</label>
            <input
                type="text"
                wire:model="no_seal"
                id="no_seal"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter seal number"
            >
            @error('no_seal') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Note -->
        <div>
            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
            <textarea
                wire:model="note"
                id="note"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter additional notes"
            ></textarea>
            @error('note') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition"
            >
                Create Shipping Instruction
            </button>
        </div>
    </form>
</div>