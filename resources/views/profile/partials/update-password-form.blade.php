<section class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <div class="p-6">
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div class="space-y-2">
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">
                    Current Password
                </label>
                <input id="update_password_current_password" 
                       name="current_password" 
                       type="password" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                       autocomplete="current-password" />
            </div>

            <div class="space-y-2">
                <label for="update_password_password" class="block text-sm font-medium text-gray-700">
                    New Password
                </label>
                <input id="update_password_password" 
                       name="password" 
                       type="password" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                       autocomplete="new-password" />
            </div>

            <div class="space-y-2">
                <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirm Password
                </label>
                <input id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       type="password" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                       autocomplete="new-password" />
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-600">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>