@extends('layouts.fullscreen')

@section('title', 'Profile')
@section('component')
    <div class="min-h-screen bg-grey-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Account Data Section -->
            <div class="bg-white/80 backdrop-blur-sm rounded-lg shadow-sm border border-white/50 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600/10 via-blue-500/8 to-indigo-600/10 px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-xl font-semibold text-gray-900">Account Data</h1>
                            <p class="text-sm text-gray-600">Manage your profile information and view account details.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Success Message -->
                    @if (session('status') === 'profile-updated')
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-green-800 font-medium">Profile updated successfully!</span>
                            </div>
                        </div>
                    @endif

                    <!-- Profile Information Display -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                            <button id="editProfileButton"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Profile
                            </button>
                        </div>

                        <!-- Personal & Company Information Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <!-- Personal Information -->
                            <div
                                class="bg-gradient-to-br from-blue-50/50 to-indigo-50/30 rounded-lg p-6 border border-blue-100/50">
                                <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Personal Information
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                                        <p class="text-gray-900 font-medium">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                        <p class="text-gray-900 font-medium">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information -->
                            <div
                                class="bg-gradient-to-br from-slate-50/50 to-gray-50/30 rounded-lg p-6 border border-gray-100/50">
                                <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Company Information
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Company Name</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_name ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Company Phone</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_phone_number ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Company Address</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_address ?: 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div
                            class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-lg p-6 border border-emerald-100/50">
                            <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Documents
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- KTP -->
                                <div class="text-center bg-white/60 rounded-lg p-4 border border-emerald-100">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">KTP</label>
                                    @if (Auth::user()->ktp)
                                        <button type="button"
                                            class="w-full px-4 py-2 text-sm font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors duration-200"
                                            onclick="toggleImage('ktpImage')">
                                            <span id="ktpButtonText">View KTP</span>
                                        </button>
                                        <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}"
                                            alt="KTP Image"
                                            class="mt-3 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div
                                            class="w-full px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>

                                <!-- NPWP -->
                                <div class="text-center bg-white/60 rounded-lg p-4 border border-emerald-100">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">NPWP</label>
                                    @if (Auth::user()->npwp)
                                        <button type="button"
                                            class="w-full px-4 py-2 text-sm font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors duration-200"
                                            onclick="toggleImage('npwpImage')">
                                            <span id="npwpButtonText">View NPWP</span>
                                        </button>
                                        <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}"
                                            alt="NPWP Image"
                                            class="mt-3 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div
                                            class="w-full px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>

                                <!-- NIB -->
                                <div class="text-center bg-white/60 rounded-lg p-4 border border-emerald-100">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">NIB</label>
                                    @if (Auth::user()->nib)
                                        <button type="button"
                                            class="w-full px-4 py-2 text-sm font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors duration-200"
                                            onclick="toggleImage('nibImage')">
                                            <span id="nibButtonText">View NIB</span>
                                        </button>
                                        <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}"
                                            alt="NIB Image"
                                            class="mt-3 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div
                                            class="w-full px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Account Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div
                                class="bg-gradient-to-br from-blue-50/50 to-indigo-50/30 rounded-lg p-4 border border-blue-100/50">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Account Created</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ Auth::user()->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div
                                class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-lg p-4 border border-emerald-100/50">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Last Updated</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ Auth::user()->updated_at->format('M d, Y') }}</dd>
                            </div>
                            <div
                                class="bg-gradient-to-br from-slate-50/50 to-gray-50/30 rounded-lg p-4 border border-gray-100/50">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Account ID</dt>
                                <dd class="text-lg font-semibold text-gray-900 font-mono">
                                    {{ str_pad(Auth::user()->user_id, 6, '0', STR_PAD_LEFT) }}</dd>
                            </div>
                            <div
                                class="bg-gradient-to-br from-green-50/50 to-emerald-50/30 rounded-lg p-4 border border-green-100/50">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Status</dt>
                                <dd>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-2 h-2 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Active
                                    </span>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="bg-white/80 backdrop-blur-sm rounded-lg shadow-sm border border-white/50 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600/8 via-green-500/6 to-teal-600/8 px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-gray-900">Security Settings</h2>
                            <p class="text-sm text-gray-600">Ensure your account is using a strong password to stay secure.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="max-w-2xl mx-auto">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="update_password_current_password"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Password
                                    </label>
                                    <input id="update_password_current_password" name="current_password" type="password"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 transition-all duration-200"
                                        autocomplete="current-password" />
                                </div>

                                <div>
                                    <label for="update_password_password"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        New Password
                                    </label>
                                    <input id="update_password_password" name="password" type="password"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 transition-all duration-200"
                                        autocomplete="new-password" />
                                </div>

                                <div>
                                    <label for="update_password_password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm Password
                                    </label>
                                    <input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 transition-all duration-200"
                                        autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div class="flex items-center">
                                    @if (session('status') === 'password-updated')
                                        <div class="flex items-center text-green-600">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm font-medium">Password updated successfully!</span>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-600/20 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white/80 backdrop-blur-sm rounded-lg shadow-sm border border-red-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600/6 via-rose-500/4 to-pink-600/6 px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-red-900">Danger Zone</h2>
                            <p class="text-sm text-red-700">Permanently delete your account and all associated data.</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-red-50/50 border border-red-100 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Account</h3>
                            <p class="text-sm text-gray-600 mb-6">
                                Once your account is deleted, all of its resources and data will be permanently deleted.
                                Before deleting your account, please download any data or information that you wish to
                                retain.
                            </p>

                            <button
                                onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'block';"
                                class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-600/20 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Account
                            </button>
                        </div>

                        <!-- Delete Account Modal -->
                        <div id="confirm-user-deletion-modal" style="display: none;"
                            class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                                <div class="bg-red-50 px-6 py-4 rounded-t-lg border-b border-red-100">
                                    <h3 class="text-xl font-semibold text-red-900">Delete Account Confirmation</h3>
                                </div>

                                <form method="post" action="{{ route('profile-destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <div class="flex items-center mb-4">
                                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            This action cannot be undone. All of your data will be permanently deleted.
                                        </p>
                                    </div>

                                    <div class="mb-6">
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                            Confirm your password to continue
                                        </label>
                                        <input id="password" name="password" type="password"
                                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-all duration-200"
                                            placeholder="Enter your password" />
                                    </div>

                                    <div class="flex justify-end gap-3">
                                        <button type="button"
                                            onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'none';"
                                            class="px-6 py-3 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500/20">
                                            Cancel
                                        </button>

                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center py-8">
                <div class="bg-white/50 backdrop-blur-sm rounded-lg px-6 py-4 inline-block">
                    <p class="text-sm text-gray-600">
                        Need help?
                        <a href="mailto:almetagt@gmail.com"
                            class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 ml-1">
                            Contact our support team
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Profile Update -->
    <div id="profileModal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div
                class="bg-gradient-to-r from-blue-600/10 via-blue-500/8 to-indigo-600/10 px-6 py-4 border-b border-blue-100 rounded-t-lg">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">Update Profile Information</h2>
                    <button id="closeModalButton"
                        class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Form - PERBAIKAN ROUTE NAME -->
            <form method="post" action="{{ route('profile-update') }}" class="p-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Personal Information
                        </h3>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input id="name" name="name" type="text"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ old('name', Auth::user()->name) }}" required />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ old('email', Auth::user()->email) }}" required />
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Company Information
                        </h3>

                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Name</label>
                            <input id="company_name" name="company_name" type="text"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ old('company_name', Auth::user()->company_name) }}" />
                        </div>

                        <div>
                            <label for="company_phone_number" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Phone</label>
                            <input id="company_phone_number" name="company_phone_number" type="tel"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ old('company_phone_number', Auth::user()->company_phone_number) }}" />
                        </div>

                        <div>
                            <label for="company_location" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Location</label>
                            <input id="company_location" name="company_location" type="text"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ old('company_location', Auth::user()->company_location) }}" />
                        </div>
                    </div>

                    <!-- Company Address (Full Width) -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company
                            Address</label>
                        <textarea id="company_address" name="company_address" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('company_address', Auth::user()->company_address) }}</textarea>
                    </div>

                    <!-- Document Updates -->
                    <div class="col-span-1 md:col-span-2 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Document Updates</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="ktp" class="block text-sm font-medium text-gray-700 mb-1">KTP</label>
                                <input id="ktp" name="ktp" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @if (Auth::user()->ktp)
                                    <p class="mt-1 text-xs text-gray-500">Current file: {{ basename(Auth::user()->ktp) }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="npwp" class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                                <input id="npwp" name="npwp" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @if (Auth::user()->npwp)
                                    <p class="mt-1 text-xs text-gray-500">Current file: {{ basename(Auth::user()->npwp) }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="nib" class="block text-sm font-medium text-gray-700 mb-1">NIB</label>
                                <input id="nib" name="nib" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @if (Auth::user()->nib)
                                    <p class="mt-1 text-xs text-gray-500">Current file: {{ basename(Auth::user()->nib) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end pt-6 border-t border-gray-200 space-x-3">
                    <button type="button" id="cancelButton"
                        class="px-6 py-3 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-3 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal handlers
            document.getElementById('editProfileButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.remove('hidden');
            });

            document.getElementById('closeModalButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.add('hidden');
            });

            document.getElementById('cancelButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.add('hidden');
            });

            // Close modal when clicking outside
            document.getElementById('profileModal').addEventListener('click', (e) => {
                if (e.target === document.getElementById('profileModal')) {
                    document.getElementById('profileModal').classList.add('hidden');
                }
            });

            // ESC key to close modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.getElementById('profileModal').classList.add('hidden');
                }
            });
        });

        function toggleImage(imageId) {
            const image = document.getElementById(imageId);
            const buttonText = document.getElementById(imageId.replace('Image', 'ButtonText'));

            if (image.classList.contains('hidden')) {
                image.classList.remove('hidden');
                buttonText.textContent = buttonText.textContent.replace('View', 'Hide');
            } else {
                image.classList.add('hidden');
                buttonText.textContent = buttonText.textContent.replace('Hide', 'View');
            }
        }
    </script>

    <style>
        /* Remove all default borders and focus styles */
        input[type="password"],
        input[type="email"],
        input[type="text"],
        textarea {
            box-shadow: none !important;
        }

        /* Custom focus states */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none !important;
        }

        /* Smooth transitions for all interactive elements */
        * {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>
@endsection
