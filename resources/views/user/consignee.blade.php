@extends('layouts.main')

@section('component')
    @livewire('consignee-management')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold">Daftar Consignee</h2>
                    <p class="text-gray-600">Total: {{ $consignees->count() }} consignee</p>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Table Container with Horizontal Scroll -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Industry</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kota</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. Telepon</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($consignees as $index => $consignee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + $consignees->firstItem() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $consignee->industry }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $consignee->name_consignee }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $consignee->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $consignee->city }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $consignee->phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('consignee-edit', $consignee->id) }}" wire:navigate
                                        class="text-blue-600 hover:text-blue-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('consignee-destroy', $consignee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin?')"
                                            class="text-red-600 hover:text-red-900">
                                            Hapus
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