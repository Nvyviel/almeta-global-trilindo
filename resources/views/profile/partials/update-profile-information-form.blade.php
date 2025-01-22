<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-gray-600">
            {{ __("View and update your account's profile information.") }}
        </p>
    </header>

    <!-- Static Profile Information -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('User Details') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Information') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Name</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->company_name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Phone Number</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->company_phone_number }}</p>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Company Address</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->company_address }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('User Documents') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- KTP -->
            <div>
                <label class="block text-sm font-medium text-gray-700">KTP</label>
                <button type="button" 
                        class="mt-1 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" 
                        onclick="toggleImage('ktpImage')">
                    Show KTP
                </button>
                @if(Auth::user()->ktp)
                    <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}" alt="KTP Image" 
                        class="mt-2 w-full max-w-md hidden">
                @else
                    <p class="mt-2 text-gray-900">No KTP file uploaded.</p>
                @endif
            </div>

            <!-- NPWP -->
            <div>
                <label class="block text-sm font-medium text-gray-700">NPWP</label>
                <button type="button" 
                        class="mt-1 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" 
                        onclick="toggleImage('npwpImage')">
                    Show NPWP
                </button>
                @if(Auth::user()->npwp)
                    <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}" alt="NPWP Image" 
                        class="mt-2 w-full max-w-md hidden">
                @else
                    <p class="mt-2 text-gray-900">No NPWP file uploaded.</p>
                @endif
            </div>

            <!-- NIB -->
            <div>
                <label class="block text-sm font-medium text-gray-700">NIB</label>
                <button type="button" 
                        class="mt-1 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" 
                        onclick="toggleImage('nibImage')">
                    Show NIB
                </button>
                @if(Auth::user()->nib)
                    <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}" alt="NIB Image" 
                        class="mt-2 w-full max-w-md hidden">
                @else
                    <p class="mt-2 text-gray-900">No NIB file uploaded.</p>
                @endif
            </div>
        </div>
    </div>


    <!-- Edit Button -->
    <div class="flex justify-end mt-6">
        <button id="editProfileButton" 
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
            {{ __('Edit') }}
        </button>
    </div>

    <!-- Modal for Profile Update -->
    <div id="profileModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <header class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">{{ __('Update Profile Information') }}</h2>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </header>
            <form method="post" action="{{ route('profile-update') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <!-- User Details -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" 
                           class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" 
                           value="{{ Auth::user()->name }}" required />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" 
                           class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" 
                           value="{{ Auth::user()->email }}" required />
                </div>

                <div class="flex justify-end mt-6">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.getElementById('editProfileButton').addEventListener('click', () => {
        document.getElementById('profileModal').classList.remove('hidden');
    });
    document.getElementById('closeModalButton').addEventListener('click', () => {
        document.getElementById('profileModal').classList.add('hidden');
    });

    function toggleImage(imageId) {
    const image = document.getElementById(imageId);
    if (image.classList.contains('hidden')) {
        image.classList.remove('hidden');
    } else {
        image.classList.add('hidden');
    }
}
</script>
