<div class="container mx-auto px-4 py-12 max-w-3xl">
    {{-- Notifications Container with Refined Styling --}}
    <div class="space-y-4 mb-6">
        {{-- Success Notification --}}
        @if (session()->has('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-gray-800 font-medium">{{ session('success') }}</p>
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
                class="w-full px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd" />
                </svg>
                Add Stock
            </button>
        </form>
    </div>
</div>
