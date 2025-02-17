<div class="container mx-auto px-4 py-6 md:py-12 max-w-3xl">
    {{-- Stock Management Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-blue-50 px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" wire:navigate
                class="text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                <i class="fa-solid fa-arrow-left-long mr-2"></i>
                <span class="text-sm sm:text-base">Back</span>
            </a>
            <h2 class="text-xl sm:text-2xl font-bold text-blue-900 text-center flex-grow">Stock Management</h2>
            <div></div>
        </div>

        {{-- Total Stock Display --}}
        <div class="p-4 sm:p-8">
            <div
                class="bg-gray-50 rounded-xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-gray-200 text-center mb-6 sm:mb-8">
                <span class="text-gray-600 font-medium text-sm sm:text-base">Total Current Stock</span>
                <div class="text-2xl sm:text-3xl font-bold text-blue-800 mt-1 sm:mt-2">
                    {{ $totalStock }}
                </div>
            </div>

            {{-- Add Stock Form --}}
            <form wire:submit.prevent="save" class="mb-6 sm:mb-8">
                <div class="grid gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                            Add Stock Quantity
                        </label>
                        <input type="number" wire:model="update_stock" placeholder="Enter stock to add"
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            min="1">
                    </div>
                </div>

                <button type="submit"
                    class="mt-4 w-full px-4 sm:px-8 py-3 sm:py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center justify-center">
                    <svg wire:loading.remove class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    <span wire:loading.remove>Add Stock</span>
                    <span wire:loading>Loading...</span>
                </button>
            </form>

            {{-- Stock Table - Responsive version --}}
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th
                                class="px-4 sm:px-6 py-2 sm:py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-4 sm:px-6 py-2 sm:py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th>
                            <th
                                class="px-4 sm:px-6 py-2 sm:py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock</th>
                            <th
                                class="px-4 sm:px-6 py-2 sm:py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($stocks as $stock)
                            <tr>
                                <td
                                    class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
                                    {{ $stock->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
                                    {{ $stock->user->name }}
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
                                    {{ $stock->stock }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm font-medium">
                                    <div class="flex flex-col sm:flex-row sm:space-x-3">
                                        <button wire:click="editModal({{ $stock->id }})"
                                            class="text-blue-600 hover:text-blue-900 mb-1 sm:mb-0">Edit</button>
                                        <button wire:click="confirmDelete({{ $stock->id }})"
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50 {{ $isModalOpen ? '' : 'hidden' }}">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full max-w-sm sm:max-w-lg sm:p-6 mx-3 sm:mx-auto">
                    <div class="absolute right-0 top-0 pr-4 pt-4">
                        <button wire:click="closeModal" type="button"
                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Edit Stock</h3>
                            <div class="mt-2">
                                <form wire:submit.prevent="updateStock">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Stock Amount</label>
                                        <input type="number" wire:model="editStock"
                                            class="w-full rounded-md border-0 py-2.5 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Save
                                            Changes</button>
                                        <button type="button" wire:click="closeModal"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showAlert', (event) => {
                Swal.fire({
                    title: event[0].title,
                    text: event[0].text,
                    icon: event[0].type,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });

            Livewire.on('showConfirmation', (event) => {
                Swal.fire({
                    title: event[0].title,
                    text: event[0].text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete', {
                            id: event[0].id
                        });
                    }
                });
            });
        });
    </script>
</div>
