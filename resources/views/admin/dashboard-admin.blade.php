@extends('layouts.main')
@section('component')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white overflow-hidden">
        {{-- Search Section --}}
        <div class="bg-gray-50 p-4 border-b border-gray-200">
            <form action="{{ route('dashboard-admin') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                <div class="flex-grow">
                    <input type="text" name="search" placeholder="Search users by email, name, or company" 
                           value="{{ request('search') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('dashboard-admin') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Results Info --}}
        <div class="p-4 bg-gray-50 text-gray-600 text-sm flex justify-between items-center">
            <span>
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
            </span>
            <span class="hidden md:block">
                Current Page: {{ $users->currentPage() }} | Total Pages: {{ $users->lastPage() }}
            </span>
        </div>

        {{-- Mobile View (Card Layout) --}}
        <div class="md:hidden">
            @foreach ($users as $user)
            <div class="bg-white border-b border-gray-200 p-4 hover:bg-gray-50 transition duration-300">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-500 font-semibold">#{{ $loop->iteration }}</span>
                    <a href="{{ route('detail-user', $user->id) }}" class="text-blue-600 underline hover:text-blue-800 font-medium">
                        {{ $user->email }}
                    </a>
                </div>
                <div class="space-y-2">
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
        <div class="hidden md:block">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="p-3 whitespace-nowrap">
                            <a href="{{ route('detail-user', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td class="p-3 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="p-3 whitespace-nowrap text-sm text-gray-900">{{ $user->company_name }}</td>
                        <td class="p-3 whitespace-nowrap text-sm text-gray-900">{{ $user->company_location }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-center">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection