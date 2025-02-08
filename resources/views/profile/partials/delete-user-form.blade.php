<section class="mt-6 bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>

    <div class="p-6">
        <button
            onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'block';"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >{{ __('Delete Account') }}</button>

        <!-- Delete Account Modal -->
        <div id="confirm-user-deletion-modal" 
             style="display: none;" 
             class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg max-w-xl w-full mx-4">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 rounded-t-xl">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Delete Account Confirmation') }}
                    </h2>
                </div>

                <form method="post" action="{{ route('profile-destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <p class="text-sm text-gray-600">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <div class="mt-6 space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Enter your password"
                        />
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" 
                                onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'none';"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>