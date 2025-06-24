@extends('layouts.main')

@section('title', 'Dashboard Admin')
@section('component')
    <div class="max-w-7xl mx-auto px-2 sm:px-4 py-4 sm:py-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 mb-6">
            <!-- Total Users Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                <div class="p-4 sm:p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2.5 rounded-lg bg-blue-50 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Users</p>
                            <p class="text-lg sm:text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Admins Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                <div class="p-4 sm:p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2.5 rounded-lg bg-amber-50 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-amber-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Admins</p>
                            <p class="text-lg sm:text-2xl font-bold text-gray-800">{{ $totalAdmins }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Ship Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                <div class="p-4 sm:p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2.5 rounded-lg bg-green-50 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm font-medium">Available Ships</p>
                            <p class="text-lg sm:text-2xl font-bold text-gray-800">{{ $totalShipments }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Seals Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                <div class="p-4 sm:p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2.5 rounded-lg bg-purple-50 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm font-medium">Stock Seals</p>
                            <p class="text-lg sm:text-2xl font-bold text-gray-800">{{ $totalSeals }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->id == 1)
            <!-- Profit Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <!-- Ship Profit Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-2.5 rounded-lg bg-blue-50 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs sm:text-sm font-medium">Ship Profit</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800">
                                    {{ App\Http\Controllers\PaymentController::formatCurrency($profits['ship_profit']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Profit Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-2.5 rounded-lg bg-green-50 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Profit</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800">
                                    {{ App\Http\Controllers\PaymentController::formatCurrency($profits['total_profit']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seal Profit Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md overflow-hidden">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-2.5 rounded-lg bg-purple-50 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs sm:text-sm font-medium">Seal Profit</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800">
                                    {{ App\Http\Controllers\PaymentController::formatCurrency($profits['seal_profit']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- User Management Section -->
        <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-gray-100">
            <!-- Header & Search -->
            <div class="bg-white p-4 sm:p-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">User Management</h2>

                <!-- Status Filter Buttons -->
                <div class="flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('dashboard-admin', ['status' => 'Under Verification']) }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition duration-200">
                        Pending Users
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold bg-yellow-200 text-yellow-800 rounded-full">
                            {{ $pendingUsersCount ?? App\Models\User::where('status', 'Under Verification')->count() }}
                        </span>
                    </a>

                    <a href="{{ route('dashboard-admin', ['status' => 'Warned']) }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition duration-200">
                        Warned Users
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold bg-red-200 text-red-800 rounded-full">
                            {{ $warnedUsersCount ?? App\Models\User::where('status', 'Warned')->count() }}
                        </span>
                    </a>
                </div>

                <form action="{{ route('dashboard-admin') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-grow">
                        <input type="text" name="search" placeholder="Search users by email, name, or company"
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2.5 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition duration-200">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>
                        @if (request('search'))
                            <a href="{{ route('dashboard-admin') }}" wire:navigate
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Info -->
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <span class="text-sm text-gray-600 font-medium">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                        entries
                    </span>
                    <span class="hidden sm:block text-sm text-gray-500">
                        Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                    </span>
                </div>
            </div>

            <!-- Mobile View (Card Layout) -->
            <div class="block sm:hidden">
                @forelse ($users as $user)
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <div class="flex justify-between items-center mb-3">
                            <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-full">ID:
                                {{ $user->user_id }}</span>
                            <a href="{{ route('detail-user', $user->id) }}" wire:navigate
                                class="text-sm text-red-600 hover:text-red-800 font-medium">
                                View Details →
                            </a>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-medium">Email</span>
                                <span class="text-sm font-medium text-gray-800">{{ $user->email }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-medium">Name</span>
                                <span class="text-sm font-medium text-gray-800">{{ $user->name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-medium">Company</span>
                                <span class="text-sm font-medium text-gray-800">{{ $user->company_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-medium">Location</span>
                                <span class="text-sm font-medium text-gray-800">{{ $user->company_location }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-medium">Status</span>
                                <span
                                    class="text-sm font-medium 
                                    {{ $user->status == 'Under Verification'
                                        ? 'text-yellow-600'
                                        : ($user->status == 'Warned'
                                            ? 'text-red-600'
                                            : 'text-green-600') }}">
                                    {{ $user->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">No users found</div>
                @endforelse
            </div>

            <!-- Desktop View (Table) -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left">
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $iteration = 0; @endphp
                        @forelse ($users as $user)
                            {{-- @if ($user->status != 'Warned' && $user->status != 'Under Verification') --}}
                            @php $iteration++; @endphp
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-3 text-sm font-medium text-gray-500">{{ $user->user_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $user->company_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $user->company_location }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span
                                        class="px-2.5 py-1 text-xs font-medium
                                        {{ $user->status == 'Under Verification'
                                            ? 'text-yellow-600'
                                            : ($user->status == 'Warned'
                                                ? 'text-red-600'
                                                : 'text-green-600') }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($user->id !== 1)
                                        <a href="{{ route('detail-user', $user->user_id) }}" wire:navigate
                                            class="text-red-600 hover:text-red-800 font-medium transition duration-200">
                                            View Details
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm">NaN</span>
                                    @endif
                                </td>
                            </tr>
                            {{-- @endif --}}
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">No users found</td>
                            </tr>
                        @endforelse

                        @if ($iteration == 0 && count($users) > 0)
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">No active users found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 bg-white border-t border-gray-100 flex items-center justify-center">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
