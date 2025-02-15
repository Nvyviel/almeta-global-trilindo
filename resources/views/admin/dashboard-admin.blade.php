@extends('layouts.main')

@section('title', 'Dashboard Admin')
@section('component')
    <div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6">
        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">
            {{-- Total Users Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-blue-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Total Users</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Admins Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-yellow-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Total Admins</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $totalAdmins }}</p>
                    </div>
                </div>
            </div>

            {{-- Available Ship Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-green-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Available Ship</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $totalShipments }}</p>
                    </div>
                </div>
            </div>

            {{-- Stock Seals Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-purple-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Stock Seals</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $totalSeals }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->id == 1)
        {{-- Profit Cards Section --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-4 sm:mb-6">
            {{-- Ship Profit Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-blue-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Ship Profit</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">
                            {{ App\Http\Controllers\PaymentController::formatCurrency($profits['ship_profit']) }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Profit Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-green-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Total Profit</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">
                            {{ App\Http\Controllers\PaymentController::formatCurrency($profits['total_profit']) }}</p>
                    </div>
                </div>
            </div>

            {{-- Seal Profit Card --}}
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-purple-100 mr-3 sm:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Seal Profit</p>
                        <p class="text-xl sm:text-2xl font-semibold text-gray-700">
                            {{ App\Http\Controllers\PaymentController::formatCurrency($profits['seal_profit']) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white overflow-hidden rounded-lg shadow">
            {{-- Search Section --}}
            <div class="bg-gray-50 p-3 sm:p-4 border-b border-gray-200">
                <form action="{{ route('dashboard-admin') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <div class="flex-grow">
                        <input type="text" name="search" placeholder="Search users by email, name, or company"
                            value="{{ request('search') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 sm:flex-none bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>
                        @if (request('search'))
                            <a href="{{ route('dashboard-admin') }}" wire:navigate
                                class="flex-1 sm:flex-none bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300 text-center text-sm">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Results Info --}}
            <div class="p-3 sm:p-4 bg-gray-50 border-b border-gray-200">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 text-xs sm:text-sm text-gray-600">
                    <span>
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    </span>
                    <span class="hidden sm:block">
                        Current Page: {{ $users->currentPage() }} | Total Pages: {{ $users->lastPage() }}
                    </span>
                </div>
            </div>

            {{-- Mobile View (Card Layout) --}}
            <div class="block sm:hidden">
                @foreach ($users as $user)
                    <div class="p-3 border-b border-gray-200 hover:bg-gray-50 transition duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-gray-500">#{{ $loop->iteration }}</span>
                            <a href="{{ route('detail-user', $user->id) }}" wire:navigate
                                class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                {{ $user->email }}
                            </a>
                        </div>
                        <div class="space-y-1.5 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Name:</span>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Company:</span>
                                <span class="font-medium">{{ $user->company_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Location:</span>
                                <span class="font-medium">{{ $user->company_location }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Desktop View (Table) --}}
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company
                            </th>
                            <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="p-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="p-3">
                                    <a href="{{ route('detail-user', $user->id) }}" wire:navigate
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $user->email }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-900">{{ $user->name }}</td>
                                <td class="p-3 text-sm text-gray-900">{{ $user->company_name }}</td>
                                <td class="p-3 text-sm text-gray-900">{{ $user->company_location }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-3 py-2 sm:px-4 sm:py-3 flex items-center justify-center border-t border-gray-200">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
