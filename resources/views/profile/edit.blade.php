@extends('layouts.fullscreen')

@section('title', 'Profile')
@section('component')
    <div class="min-h-screen bg-gray-50 py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Back Button -->
            <div>
                <a href="{{ route('dashboard') }}" wire:navigate class="btn-secondary">&larr; Back</a>
            </div>
            
            <!-- Profile Header Section -->
            <div class="rounded-md overflow-hidden">
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-900">Security</h1>
                </div>
                <div class="p-6">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-900 text-red-600">Danger Zone</h1>
                </div>
                <div class="p-6">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Form Buttons Style Guide -->
            <style>
                /* Primary Button */
                .btn-primary {
                    @apply inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white tracking-wider hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition ease-in-out duration-150;
                }

                /* Secondary Button */
                .btn-secondary {
                    @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 tracking-wider hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition ease-in-out duration-150;
                }

                /* Danger Button */
                .btn-danger {
                    @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white tracking-wider hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50 transition ease-in-out duration-150;
                }

                /* Form Input */
                .form-input {
                    @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm;
                }

                /* Form Label */
                .form-label {
                    @apply block text-sm font-medium text-gray-700;
                }
            </style>
        </div>
    </div>
@endsection
