<x-guest-layout>
    @section('title-guest', 'Pending Page')
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Account Status -->
            <div class="bg-white shadow-sm rounded-lg mb-6 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 px-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white">Account Verification Status</h1>
                            <p class="text-blue-100 mt-1">Please complete all required steps below to gain access to the
                                dashboard</p>
                        </div>
                        <div class="text-right text-sm text-blue-100">
                            <div>{{ date('F j, Y', strtotime('2025-03-29')) }}</div>
                            <div>{{ date('h:i A', strtotime('07:59:43')) }}</div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- User Info -->
                    <div class="flex items-center mb-6">
                        <div
                            class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                            {{ substr(Auth::user()->name ?? 'Nvyviel', 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Welcome,</p>
                            <p class="font-medium text-gray-900">{{ Auth::user()->name ?? 'Nvyviel' }}</p>
                        </div>
                        <div class="ml-auto">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Status Card -->
                    @if (auth()->user()->status === 'Warned')
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Account Warning</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>Your account has been flagged for violation of our terms of service. Please
                                            verify your documents properly to continue.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Pending Approval</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Your account is awaiting admin verification. Please ensure all documents are
                                            up to date and properly submitted.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Approval Progress -->
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-2">Verification Progress</h2>
                        <div class="bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="grid grid-cols-3 text-sm">
                            <div class="text-blue-600 font-medium">Documents Uploaded</div>
                            <div class="text-center text-gray-500">Under Review</div>
                            <div class="text-right text-gray-500">Approval</div>
                        </div>
                    </div>

                    <!-- Approval Timeline -->
                    <div class="bg-blue-50 rounded-lg p-4 mb-6">
                        <h2 class="text-md font-medium text-blue-800 mb-2">Estimated Timeline</h2>
                        <p class="text-sm text-blue-700">Document verification typically takes 1-2 business days. You
                            will receive an email notification once your account is approved.</p>
                    </div>
                </div>
            </div>

            <section>
                <!-- Document Management Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ __('Required Documents') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('Please ensure all documents are clear, valid, and up to date.') }}
                        </p>
                    </div>

                    <!-- User Documents Section -->
                    <div class="p-6 space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Your Documents') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- KTP -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <label class="text-sm font-medium text-gray-700">KTP (ID Card)</label>
                                        @if (Auth::user()->ktp)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Uploaded</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                        @endif
                                    </div>
                                    <button type="button"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="toggleImage('ktpImage')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View KTP
                                    </button>
                                    @if (Auth::user()->ktp)
                                        <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}"
                                            alt="KTP Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700 truncate">
                                            {{ basename(Auth::user()->ktp) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-red-500">No KTP file uploaded</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('ktp')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                        Upload KTP
                                    </button>
                                </div>

                                <!-- NPWP -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <label class="text-sm font-medium text-gray-700">NPWP (Tax ID)</label>
                                        @if (Auth::user()->npwp)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Uploaded</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                        @endif
                                    </div>
                                    <button type="button"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="toggleImage('npwpImage')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View NPWP
                                    </button>
                                    @if (Auth::user()->npwp)
                                        <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}"
                                            alt="NPWP Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700 truncate">
                                            {{ basename(Auth::user()->npwp) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-red-500">No NPWP file uploaded</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('npwp')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                        Upload NPWP
                                    </button>
                                </div>

                                <!-- NIB -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <label class="text-sm font-medium text-gray-700">NIB (Business License)</label>
                                        @if (Auth::user()->nib)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Uploaded</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                        @endif
                                    </div>
                                    <button type="button"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="toggleImage('nibImage')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View NIB
                                    </button>
                                    @if (Auth::user()->nib)
                                        <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}"
                                            alt="NIB Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700 truncate">
                                            {{ basename(Auth::user()->nib) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-red-500">No NIB file uploaded</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('nib')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                        Upload NIB
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support and Help Section -->
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ __('Need Help?') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Having trouble with document submission?
                                </h3>
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>If you're experiencing any issues with your document submission or have questions
                                        about the verification process, please contact our support team at <a
                                            href="mailto:support@example.com"
                                            class="text-blue-600 hover:text-blue-500">almetagt@gmail.com</a> or call
                                        us at <span class="font-medium">+62 821 4253 4093</span>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Document Update -->
                <div id="documentModal"
                    class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
                    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4">
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900" id="modalTitle">Update Document</h2>
                                <button id="closeDocumentModalButton" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <form method="post" action="{{ route('update-document') }}" class="p-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" id="documentType" name="document_type" value="">

                            <div>
                                <label for="documentFile" class="block text-sm font-medium text-gray-700"
                                    id="documentLabel">Document</label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="documentFile"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input id="documentFile" name="document" type="file"
                                                    accept="image/*,.pdf" class="sr-only" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            JPG, PNG, or PDF up to 2MB
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="button" id="cancelDocumentButton"
                                    class="mr-3 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Upload Document') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <script>
                function toggleImage(imageId) {
                    const image = document.getElementById(imageId);
                    if (image.classList.contains('hidden')) {
                        image.classList.remove('hidden');
                    } else {
                        image.classList.add('hidden');
                    }
                }

                function openDocumentModal(documentType) {
                    // Set the document type and update modal title
                    document.getElementById('documentType').value = documentType;

                    // Update modal title and label based on document type
                    let documentName = '';
                    let documentDesc = '';
                    switch (documentType) {
                        case 'ktp':
                            documentName = 'KTP';
                            documentDesc = 'ID Card';
                            break;
                        case 'npwp':
                            documentName = 'NPWP';
                            documentDesc = 'Tax ID';
                            break;
                        case 'nib':
                            documentName = 'NIB';
                            documentDesc = 'Business License';
                            break;
                        default:
                            documentName = 'Document';
                    }

                    document.getElementById('modalTitle').textContent = `Upload ${documentName} (${documentDesc})`;
                    document.getElementById('documentLabel').textContent = documentName;
                    document.getElementById('documentModal').classList.remove('hidden');
                }

                document.getElementById('closeDocumentModalButton').addEventListener('click', () => {
                    document.getElementById('documentModal').classList.add('hidden');
                });

                document.getElementById('cancelDocumentButton').addEventListener('click', () => {
                    document.getElementById('documentModal').classList.add('hidden');
                });

                // Close modal when clicking outside of it
                document.getElementById('documentModal').addEventListener('click', (event) => {
                    if (event.target === document.getElementById('documentModal')) {
                        document.getElementById('documentModal').classList.add('hidden');
                    }
                });
            </script>
        </div>
    </div>
</x-guest-layout>
