@extends('layouts.fullscreen')
@section('title', 'Detail')
@section('component')
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">
            {{-- Header Section --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <h1 class="text-3xl font-bold text-white mb-4 md:mb-0 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        User Detail
                    </h1>
                    <a href="{{ route('dashboard-admin') }}" wire:navigate
                        class="inline-flex items-center px-5 py-2 bg-white text-blue-600 rounded-lg shadow-md hover:bg-blue-50 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                {{-- Account Information --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Account Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Email</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->email }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Nama</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->name }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Status Admin</span>
                            <span
                                class="px-4 py-1 rounded-full text-sm font-medium {{ $user->is_admin ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $user->is_admin ? 'Administrator' : 'User' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Company Information --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Company</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->company_name }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Contact Number</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->company_phone_number }}</span>
                        </div>
                        <div class="flex justify-between items-start p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-600">Address</span>
                            <span
                                class="text-sm font-semibold text-gray-900 text-right w-1/2">{{ $user->company_address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Admin Status Change Button --}}
            @if (auth()->user()->id == 1 && $user->id != 1)
                <div class="flex justify-center px-8 pb-8">
                    <form id="adminStatusForm" action="{{ route('isadmin', $user->id) }}" method="POST">
                        @csrf
                        <button type="button"
                            onclick="confirmAdminStatusChange('{{ $user->name }}', {{ $user->is_admin }})"
                            class="inline-flex items-center px-6 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                           {{ $user->is_admin
                               ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200'
                               : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $user->is_admin
                                        ? 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                                        : 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' }}" />
                            </svg>
                            {{ $user->is_admin ? 'Make to User' : 'Make to Administrator' }}
                        </button>
                    </form>
                </div>
            @endif

            {{-- Documents Section --}}
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-8 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Document
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach (['ktp' => 'KTP', 'npwp' => 'NPWP', 'nib' => 'NIB'] as $doc => $label)
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 text-center uppercase tracking-wider">
                                    {{ $label }}</h3>
                            </div>
                            <div class="p-4">
                                <button
                                    onclick="openModal('{{ asset('storage/' . $user->$doc) }}', '{{ $label }}')"
                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Image
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="imageModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 backdrop-blur-sm flex items-center justify-center">
        <div class="relative max-w-4xl mx-auto">
            <button onclick="closeModal()"
                class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img id="modalImage" src="" alt="Document"
                class="max-w-full max-h-[80vh] object-contain rounded-lg">
            <p id="modalTitle" class="text-white text-center mt-4 text-xl font-medium"></p>
        </div>
    </div>

    <script>
        function openModal(src, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            modalImage.src = src;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('imageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });

        function confirmAdminStatusChange(userName, isAdmin) {
            const newStatus = isAdmin ? 'User' : 'Administrator';
            const icon = isAdmin ? 'warning' : 'question';
            const confirmButtonColor = isAdmin ? '#EAB308' : '#22C55E';

            Swal.fire({
                title: 'Are you sure?',
                html: `Do you want to change <strong>${userName}</strong>'s status to <strong>${newStatus}</strong>?`,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#DC2626',
                confirmButtonText: `Yes, make ${newStatus}!`,
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adminStatusForm').submit();
                }
            });
        }
    </script>
@endsection
