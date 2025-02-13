<div class="container mx-auto px-4 py-12 max-w-3xl">
    {{-- Notifications Container with Refined Styling --}}
    <div class="space-y-4 mb-6">
        {{-- Success Notification --}}
        @if (session('success'))
            <div
                class="flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <div>
                    <span class="mt-2 list-disc list-inside">
                        {{ session('success') }}
                    </span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        @endif
    </div>

    {{-- Stock Management Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-blue-50 px-6 py-5 border-b border-gray-200 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" wire:navigate
                class="text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                <i class="fa-solid fa-arrow-left-long mr-2"></i>
                Back
            </a>
            <h2 class="text-2xl font-bold text-blue-900 text-center flex-grow">Stock Management</h2>
            <div></div>
        </div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            {{-- Total Stock Display --}}
            <div class="bg-gray-50 rounded-xl p-6 space-y-4 border border-gray-200 text-center">
                <span class="text-gray-600 font-medium">Total Current Stock</span>
                <div class="text-3xl font-bold text-blue-800 mt-2">
                    {{ $totalStock }}
                </div>
            </div>

            {{-- Stock Addition Section --}}
            <div class="grid gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Add Stock Quantity
                    </label>
                    <input type="number" wire:model="update_stock" placeholder="Enter stock to add"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="1">
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center justify-center"
                wire:loading.class="opacity-75 cursor-wait" wire:loading.attr="disabled">

                {{-- Loading Spinner (hidden by default) --}}
                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>

                {{-- Button Icon (shown when not loading) --}}
                <svg wire:loading.remove class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd" />
                </svg>

                {{-- Button Text --}}
                <span wire:loading.remove>Add Stock</span>
                <span wire:loading>Adding...</span>
            </button>
        </form>
    </div>
</div>
