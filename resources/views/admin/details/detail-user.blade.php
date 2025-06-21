@extends('layouts.fullscreen')
@section('title', 'User Detail')
@section('component')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            {{-- Enhanced Header Section with Background Pattern --}}
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-10">
                <div class="absolute inset-0 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <defs>
                            <pattern id="header-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M0 20 L20 0 L40 20 L20 40 Z" fill="none" stroke="currentColor"
                                    stroke-width="1" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#header-pattern)" />
                    </svg>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                    <a href="{{ route('dashboard-admin') }}" wire:navigate
                        class="inline-flex items-center px-5 py-2.5 bg-white text-blue-600 rounded-lg shadow-md hover:bg-blue-50 transform hover:scale-105 transition-all duration-200 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Dashboard
                    </a>
                    <h1 class="text-3xl font-bold text-white mb-4 md:mb-0 flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span>User Detail</span>
                    </h1>
                </div>
            </div>

            {{-- User Status Badges (Redesigned) --}}
            <div class="flex justify-center -mt-5 mb-4 relative z-10">
                <div class="flex flex-col items-center">
                    <div class="flex gap-2">
                        <span
                            class="px-6 py-2 rounded-full text-sm font-bold shadow-lg
                            {{ $user->is_admin
                                ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white'
                                : 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' }}">
                            {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                        </span>

                        {{-- Account Status Badge --}}
                        <span
                            class="px-4 py-2 rounded-full text-sm font-bold shadow 
                            {{ $user->status == 'Approved'
                                ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                                : ($user->status == 'Warned'
                                    ? 'bg-red-100 text-red-800 border border-red-200'
                                    : 'bg-yellow-100 text-yellow-800 border border-yellow-200') }}">
                            <span class="flex items-center">
                                @if ($user->status == 'Approved')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($user->status == 'Warned')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                                {{ $user->status }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Admin Actions Section (Left-aligned) --}}
            @if (auth()->user()->is_admin && $user->id != 1)
                <div class="px-8 mb-6">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Actions
                        </h3>

                        <div class="flex flex-wrap gap-3">
                            {{-- Admin Status Toggle Button --}}
                            @if (auth()->user()->id == 1)
                                <form id="adminStatusForm" action="{{ route('isadmin', $user->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="button"
                                        onclick="confirmAdminStatusChange('{{ $user->name }}', {{ $user->is_admin }})"
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow
                                        {{ $user->is_admin
                                            ? 'bg-yellow-500 text-white hover:bg-yellow-600'
                                            : 'bg-indigo-600 text-white hover:bg-indigo-700' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $user->is_admin
                                                    ? 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                                                    : 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' }}" />
                                        </svg>
                                        {{ $user->is_admin ? 'Remove Admin Access' : 'Make Administrator' }}
                                    </button>
                                </form>
                            @endif

                            {{-- Approve Button - Only show if user is not Approved --}}
                            @if ($user->status != 'Approved')
                                <form action="{{ route('update-status', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="button"
                                        onclick="confirmStatusChange(this.form, 'Approved', '{{ $user->name }}')"
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium shadow 
                                        bg-green-600 text-white hover:bg-green-700 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Approve User
                                    </button>
                                </form>
                            @endif

                            {{-- Warn Button - Only show if user is not Warned --}}
                            @if ($user->status != 'Warned')
                                <form action="{{ route('update-status', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="Warned">
                                    <button type="button"
                                        onclick="confirmStatusChange(this.form, 'Warned', '{{ $user->name }}')"
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium shadow 
                                        bg-orange-500 text-white hover:bg-orange-600 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Warn User
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Content with Improved Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 pt-0">
                {{-- Account Information --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Account Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500 hover:bg-blue-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email
                                Address</span>
                            <span class="text-base font-semibold text-gray-900">{{ $user->email }}</span>
                        </div>
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500 hover:bg-blue-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Full
                                Name</span>
                            <span class="text-base font-semibold text-gray-900">{{ $user->name }}</span>
                        </div>
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500 hover:bg-blue-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Account
                                Type</span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium w-fit mt-1
                                {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                <span
                                    class="w-2 h-2 rounded-full mr-2 {{ $user->is_admin ? 'bg-purple-600' : 'bg-blue-600' }}"></span>
                                {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                            </span>
                        </div>
                        <div
                            class="flex flex-col p-4 rounded-lg transition-colors duration-200
                            {{ $user->status == 'Approved'
                                ? 'bg-green-50 border-l-4 border-green-500 hover:bg-green-50/70'
                                : ($user->status == 'Warned'
                                    ? 'bg-red-50 border-l-4 border-red-500 hover:bg-red-50/70'
                                    : 'bg-yellow-50 border-l-4 border-yellow-500 hover:bg-yellow-50/70') }}">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Account
                                Status</span>
                            <span
                                class="text-base font-semibold 
                                {{ $user->status == 'Approved'
                                    ? 'text-green-800'
                                    : ($user->status == 'Warned'
                                        ? 'text-red-800'
                                        : 'text-yellow-800') }}">
                                {{ $user->status }}
                            </span>
                            <span
                                class="text-xs mt-1 
                                {{ $user->status == 'Approved'
                                    ? 'text-green-600'
                                    : ($user->status == 'Warned'
                                        ? 'text-red-600'
                                        : 'text-yellow-600') }}">
                                Last updated: {{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                WIB
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Company Information --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500 hover:bg-purple-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Company
                                Name</span>
                            <span class="text-base font-semibold text-gray-900">{{ $user->company_name }}</span>
                        </div>
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500 hover:bg-purple-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Phone
                                Number</span>
                            <span class="text-base font-semibold text-gray-900">+62
                                {{ $user->company_phone_number }}</span>
                        </div>
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500 hover:bg-purple-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Company
                                Location</span>
                            <span class="text-base font-semibold text-gray-900">{{ $user->company_location }}</span>
                        </div>
                        <div
                            class="flex flex-col p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500 hover:bg-purple-50 transition-colors duration-200">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Company
                                Address</span>
                            <span class="text-base font-semibold text-gray-900">{{ $user->company_address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enhanced Documents Section with Glass Morphism --}}
            <div class="relative overflow-hidden pb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-70"></div>
                <div class="absolute inset-0 opacity-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <defs>
                            <pattern id="docs-pattern" width="60" height="60" patternUnits="userSpaceOnUse">
                                <path d="M-10 22.5 L25 -12.5 L60 22.5 L25 57.5 Z" fill="none" stroke="currentColor"
                                    stroke-width="1" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#docs-pattern)" />
                    </svg>
                </div>
                <div class="p-8 relative z-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        Required Documents
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach (['ktp' => 'KTP', 'npwp' => 'NPWP', 'nib' => 'NIB'] as $doc => $label)
                            <div
                                class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200">
                                <div class="relative h-40 bg-gray-100 overflow-hidden">
                                    <!-- Document Preview Image with Blur -->
                                    <div class="absolute inset-0 bg-cover bg-center blur-sm scale-105"
                                        style="background-image: url('{{ asset('storage/' . $user->$doc) }}');"></div>
                                    <!-- Gradient Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent">
                                    </div>
                                    <!-- Document Icon -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div
                                            class="p-3 rounded-full bg-white/20 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-14 w-14 text-white drop-shadow-md" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Document Name -->
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <h3 class="text-lg font-bold text-white text-center">{{ $label }}</h3>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <button
                                        onclick="openModal('{{ asset('storage/' . $user->$doc) }}', '{{ $label }}')"
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-4 rounded-lg shadow 
                                        hover:from-blue-700 hover:to-indigo-700 transition-colors duration-300 flex items-center justify-center gap-2 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Document
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Footer with Status Timeline --}}
        @if ($user->id != 1)
            <div class="mt-6 bg-white rounded-xl shadow-md p-6 max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Account Status Timeline</h3>
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">Last Updated:</span>
                        {{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB
                    </div>
                </div>

                <div class="relative">
                    {{-- Timeline Track --}}
                    <div class="absolute left-0 ml-5 w-0.5 h-full bg-gray-200"></div>

                    {{-- Timeline Items --}}
                    <div class="space-y-6 relative">
                        {{-- Current Status --}}
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white">
                                <span
                                    class="flex h-10 w-10 rounded-full border-4
                                {{ $user->status == 'Approved'
                                    ? 'border-green-500 bg-green-100 text-green-600'
                                    : ($user->status == 'Warned'
                                        ? 'border-red-500 bg-red-100 text-red-600'
                                        : 'border-yellow-500 bg-yellow-100 text-yellow-600') }}
                                items-center justify-center">
                                    @if ($user->status == 'Approved')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif($user->status == 'Warned')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </span>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-base font-semibold text-gray-800">Current Status: {{ $user->status }}</h4>
                                <p class="text-sm text-gray-600">Last updated by administrator</p>
                            </div>
                        </div>

                        {{-- Account Creation --}}
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white">
                                <span
                                    class="flex h-10 w-10 rounded-full border-4 border-blue-500 bg-blue-100 text-blue-600 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-base font-semibold text-gray-800">Account Created</h4>
                                <p class="text-sm text-gray-600">
                                    {{ $user->created_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-center text-xs text-gray-500 mt-6">
                    Viewed by {{ auth()->user()->name }} on {{ now()->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }}
                    WIB
                </p>
            </div>
        @endif
    </div>

    {{-- Enhanced Modal --}}
    <div id="imageModal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 backdrop-blur-md flex items-center justify-center">
        <div class="relative max-w-4xl mx-auto p-2">
            <!-- Close button with enhanced styling -->
            <button onclick="closeModal()"
                class="absolute -top-16 right-0 text-white hover:text-gray-300 transition-colors p-2 rounded-full bg-black/30 backdrop-blur-sm hover:bg-black/50 group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 transform group-hover:rotate-90 transition-transform duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Image container with loading animation -->
            <div class="bg-gray-900 rounded-xl overflow-hidden shadow-2xl relative">
                <div id="imageLoading" class="absolute inset-0 flex items-center justify-center bg-gray-900">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-white"></div>
                </div>
                <img id="modalImage" src="" alt="Document"
                    class="max-w-full max-h-[80vh] object-contain rounded-lg transition-opacity duration-300 opacity-0"
                    onload="this.classList.remove('opacity-0'); document.getElementById('imageLoading').classList.add('hidden');">
            </div>

            <!-- Document title with badge -->
            <div class="text-center mt-6">
                <span
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-full shadow-lg text-lg font-bold inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span id="modalTitle"></span>
                </span>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function confirmStatusChange(form, status, userName) {
            const isApprove = status === 'Approved';
            const icon = isApprove ? 'success' : 'warning';
            const confirmButtonColor = isApprove ? '#22C55E' : '#EAB308';
            const title = isApprove ? 'Approve User?' : 'Set to Warned?';
            const text = isApprove ?
                `Are you sure you want to approve ${userName}?` :
                `Are you sure you want to set ${userName}'s status to warned?`;

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#DC2626',
                confirmButtonText: isApprove ? 'Yes, Approve!' : 'Yes, Set to Warned!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        function openModal(src, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const imageLoading = document.getElementById('imageLoading');

            // Reset loading state
            imageLoading.classList.remove('hidden');
            modalImage.classList.add('opacity-0');

            // Set image source and title
            modalImage.src = src;
            modalTitle.textContent = title;

            // Show modal with animation
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.querySelector('.relative').classList.add('animate-fadeIn');
            }, 10);

            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';

            // Reset image after animation completes
            setTimeout(() => {
                document.getElementById('modalImage').src = '';
            }, 300);
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

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Enhanced card hover effects */
        .hover-lift {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Floating animation for icons */
        .float-animation {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
@endsection
