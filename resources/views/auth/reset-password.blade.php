<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Reset Password</h2>
        <p class="mt-2 text-sm text-gray-600 text-center">
            {{ __('Enter your new password below to reset your account password.') }}
        </p>

        <form method="POST" action="{{ route('password.store') }}" class="mt-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email"
                    class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    type="email" name="email" :value="old('email', $request - > email)" required autofocus
                    autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="password"
                    class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                    Password</label>
                <input id="password_confirmation"
                    class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:ring focus:ring-blue-300">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
