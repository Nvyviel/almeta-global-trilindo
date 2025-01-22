<x-app-layout>
    @section('layout')  
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Profile Header -->
            <div class="p-6 bg-white shadow sm:rounded-lg block items-center gap-4">
                <div class="flex">
                    <img src="../assets/img/AGT IMG 1.png" alt="Profile Picture" 
                        class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover">
                    <div class="items-center">
                        <p class="text-2xl sm:text-4xl font-bold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-sm sm:text-base text-gray-500">Manage your account settings below</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
