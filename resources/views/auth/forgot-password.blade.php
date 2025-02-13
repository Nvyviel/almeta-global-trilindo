<x-guest-layout>
    @section('title-guest', 'Forgot Password')

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Forgot Password</h2>
        <p class="mt-2 text-sm text-gray-600 text-center">
            {{ __('Forgot your password? No problem. Just enter your email address and we will send you a link to reset your password.') }}
        </p>

        <form method="POST" action="{{ route('password.email') }}" class="mt-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email"
                    class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:ring focus:ring-blue-300">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
