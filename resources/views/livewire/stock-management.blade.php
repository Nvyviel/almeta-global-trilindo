<div class="container mx-auto px-4 py-8 max-w-md">
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                </svg>
                Stock Management
            </h2>
        </div>

        <div class="p-6 space-y-6">
            {{-- Total Stock Display --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                <span class="text-gray-600 text-sm">Total Current Stock</span>
                <div class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalStock }}
                </div>
            </div>

            {{-- Stock Addition Form --}}
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Add Stock Quantity
                    </label>
                    <input 
                        type="number" 
                        wire:model="update_stock" 
                        placeholder="Enter stock to add"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        min="1"
                    >
                </div>
                
                <button 
                    type="submit" 
                    class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                    </svg>
                    Add Stock
                </button>
            </form>

            {{-- Success Notification --}}
            @if(session()->has('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>