<x-guest-layout>
    @section('title-guest', 'Pending')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Login
                </button>
            </form>
            @if (auth()->user()->status === 'Warned')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <strong class="font-bold">Important!</strong>
                        <span class="ml-2">Our team cannot Approved before using your Document correctly.</span>
                    </div>
                </div>
            @endif
            <section>
                <!-- Document Management Section -->
                <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ __('Document Management') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('View and update your official documents.') }}
                        </p>
                    </div>

                    <!-- User Documents Section -->
                    <div class="p-6 space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Your Documents') }}</h3>
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
                                        <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}"
                                            alt="KTP Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700">
                                            Current file: {{ basename(Auth::user()->ktp) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500">No KTP file uploaded.</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('ktp')">
                                        Update KTP
                                    </button>
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
                                        <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}"
                                            alt="NPWP Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700">
                                            Current file: {{ basename(Auth::user()->npwp) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500">No NPWP file uploaded.</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('npwp')">
                                        Update NPWP
                                    </button>
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
                                        <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}"
                                            alt="NIB Image"
                                            class="mt-2 w-full max-w-md hidden border border-gray-200 rounded-md">
                                        <p class="mt-2 text-sm text-gray-700">
                                            Current file: {{ basename(Auth::user()->nib) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500">No NIB file uploaded.</p>
                                    @endif
                                    <button type="button"
                                        class="mt-2 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="openDocumentModal('nib')">
                                        Update NIB
                                    </button>
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
                                <input id="documentFile" name="document" type="file" accept="image/*,.pdf"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                    required />
                                <p class="mt-2 text-sm text-gray-500">Accepted formats: JPG, JPEG, PNG, PDF. Maximum
                                    size: 2MB.</p>
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
                    switch (documentType) {
                        case 'ktp':
                            documentName = 'KTP';
                            break;
                        case 'npwp':
                            documentName = 'NPWP';
                            break;
                        case 'nib':
                            documentName = 'NIB';
                            break;
                        default:
                            documentName = 'Document';
                    }

                    document.getElementById('modalTitle').textContent = `Update ${documentName}`;
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
</x-guest-layout>
