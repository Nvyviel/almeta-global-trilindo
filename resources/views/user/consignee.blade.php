@extends('layouts.main')

@section('title', 'Consignee')
@section('component')
    <div class="mx-4">
        <a href="{{ route('create-consignee') }}" wire:navigate
            class="bg-red-700 text-white px-3 py-2 rounded-full hover:bg-red-800 inline-flex items-center">
            + Consignee
        </a>
    </div>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold">Your Consignee</h2>
                    <p class="text-gray-600">Total: {{ $consignees->count() }} consignee</p>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Table Container with Horizontal Scroll -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Industry</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                City</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Phone Number</th>
                            <th
                                class="px-4 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($consignees as $index => $consignee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap">{{ $index + $consignees->firstItem() }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $consignee->industry }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $consignee->name_consignee }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $consignee->email }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ strtoupper($consignee->city) }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $consignee->phone_number }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('consignee-edit', $consignee->id) }}" wire:navigate
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('consignee-destroy', $consignee->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin?')"
                                                class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data consignee
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $consignees->links() }}
            </div>
        </div>
    </div>
@endsection
