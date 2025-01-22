@extends('layouts.main')
@section('component')
<div class="pt-10 px-4">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden rounded-md shadow-lg">
                    <table class="min-w-full divide-y divide-gray-200 bg-white">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No.</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Company Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Phone Number</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Company Address</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Admin</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">KTP</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">NPWP</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">NIB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->company_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->company_phone_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->company_address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800">
                                    <form action="{{ route('isadmin', $user->id) }}" method="POST">
                                        @csrf
                                        <input type="checkbox" 
                                            name="is_admin" 
                                            {{ $user->id == 1 ? 'disabled' : ''}}
                                            {{ $user->is_admin ? 'checked' : '' }} 
                                            {{ auth()->user()->id != 1 ? 'disabled' : '' }} 
                                            onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <img src="{{ asset('storage/' . $user->ktp) }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <img src="{{ asset('storage/' . $user->npwp) }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <img src="{{ asset('storage/' . $user->nib) }}">
                                </td>
                            </tr>
                            @endforeach
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection