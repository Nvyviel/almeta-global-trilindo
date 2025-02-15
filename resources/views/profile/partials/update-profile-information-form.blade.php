<section>
    <!-- Profile Header -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ __("View and update your account's profile information.") }}
            </p>
        </div>

        <!-- User Details Section -->
        <div class="p-6 space-y-6">
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('User Details') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <p class="mt-1 text-gray-900 bg-white p-2 rounded-md border border-gray-200">
                            {{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-gray-900 bg-white p-2 rounded-md border border-gray-200">
                            {{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Company Information Section -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Information') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company Name</label>
                        <p class="mt-1 text-gray-900 bg-white p-2 rounded-md border border-gray-200">
                            {{ Auth::user()->company_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company Phone Number</label>
                        <p class="mt-1 text-gray-900 bg-white p-2 rounded-md border border-gray-200">
                            {{ Auth::user()->company_phone_number }}</p>
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Company Address</label>
                        <p class="mt-1 text-gray-900 bg-white p-2 rounded-md border border-gray-200">
                            {{ Auth::user()->company_address }}</p>
                    </div>
                </div>
            </div>

            <!-- User Documents Section -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('User Documents') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- KTP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">KTP</label>
                        <button type="button"
                            class="mt-1 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="toggleImage('ktpImage')">
                            Show KTP
                        </button>
                        @if (Auth::user()->ktp)
                            <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}" alt="KTP Image"
                                class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No KTP file uploaded.</p>
                        @endif
                    </div>

                    <!-- NPWP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NPWP</label>
                        <button type="button"
                            class="mt-1 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="toggleImage('npwpImage')">
                            Show NPWP
                        </button>
                        @if (Auth::user()->npwp)
                            <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}" alt="NPWP Image"
                                class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No NPWP file uploaded.</p>
                        @endif
                    </div>

                    <!-- NIB -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIB</label>
                        <button type="button"
                            class="mt-1 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="toggleImage('nibImage')">
                            Show NIB
                        </button>
                        @if (Auth::user()->nib)
                            <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}" alt="NIB Image"
                                class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No NIB file uploaded.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="flex justify-end pt-4">
                <button id="editProfileButton"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Edit Profile') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Modal for Profile Update -->
    <div id="profileModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl mx-4">
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('Update Profile Information') }}</h2>
                    <button id="closeModalButton" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form method="post" action="{{ route('profile-update') }}" class="p-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ Auth::user()->name }}" required />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ Auth::user()->email }}" required />
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Company Information</h3>

                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company
                                Name</label>
                            <input id="company_name" name="company_name" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ Auth::user()->company_name }}" required />
                        </div>

                        <div>
                            <label for="company_phone_number" class="block text-sm font-medium text-gray-700">Company
                                Phone Number</label>
                            <input id="company_phone_number" name="company_phone_number" type="tel"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ Auth::user()->company_phone_number }}" required />
                        </div>

                        <div>
                            <label for="company_location" class="block text-sm font-medium text-gray-700">Company
                                Location</label>
                            <input id="company_location" name="company_location" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ Auth::user()->company_location }}" required />
                        </div>
                    </div>

                    <!-- Company Address (Full Width) -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="company_address" class="block text-sm font-medium text-gray-700">Company
                            Address</label>
                        <textarea id="company_address" name="company_address" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            required>{{ Auth::user()->company_address }}</textarea>
                    </div>

                    <!-- Document Updates -->
                    <div class="col-span-1 md:col-span-2 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Document Updates</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="ktp" class="block text-sm font-medium text-gray-700">KTP</label>
                                <input id="ktp" name="ktp" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <div>
                                <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                                <input id="npwp" name="npwp" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <div>
                                <label for="nib" class="block text-sm font-medium text-gray-700">NIB</label>
                                <input id="nib" name="nib" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="button" id="cancelButton"
                        class="mr-3 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('Save Changes') }}
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

    document.getElementById('cancelButton').addEventListener('click', () => {
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
