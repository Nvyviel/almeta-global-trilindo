@extends('layouts.main')

@section('component')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Shipment</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('update-shipment', $shipment->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- From City -->
                <div>
                    <label for="from_city" class="block text-sm font-medium text-gray-700">From City</label>
                    <select name="from_city" id="from_city" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                            @error('from_city') border-red-500 @enderror">
                        @foreach($cities as $key => $city)
                            <option value="{{ $key }}" {{ $shipment->from_city == $key ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('from_city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- To City -->
                <div>
                    <label for="to_city" class="block text-sm font-medium text-gray-700">To City</label>
                    <select name="to_city" id="to_city" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                            @error('to_city') border-red-500 @enderror">
                        @foreach($cities as $key => $city)
                            <option value="{{ $key }}" {{ $shipment->to_city == $key ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('to_city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vessel Name -->
                <div>
                    <label for="vessel_name" class="block text-sm font-medium text-gray-700">Vessel Name</label>
                    <input type="text" name="vessel_name" id="vessel_name" 
                           value="{{ old('vessel_name', $shipment->vessel_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                           @error('vessel_name') border-red-500 @enderror">
                    @error('vessel_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Closing Cargo -->
                <div>
                    <label for="closing_cargo" class="block text-sm font-medium text-gray-700">Closing Cargo</label>
                    <input type="datetime-local" name="closing_cargo" id="closing_cargo"
                           value="{{ old('closing_cargo', date('Y-m-d\TH:i', strtotime($shipment->closing_cargo))) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                           @error('closing_cargo') border-red-500 @enderror">
                    @error('closing_cargo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ETB -->
                <div>
                    <label for="etb" class="block text-sm font-medium text-gray-700">ETB (Estimated Time of Berth)</label>
                    <input type="datetime-local" name="etb" id="etb"
                           value="{{ old('etb', date('Y-m-d\TH:i', strtotime($shipment->etb))) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                           @error('etb') border-red-500 @enderror">
                    @error('etb')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ETD -->
                <div>
                    <label for="etd" class="block text-sm font-medium text-gray-700">ETD (Estimated Time of Departure)</label>
                    <input type="datetime-local" name="etd" id="etd"
                           value="{{ old('etd', date('Y-m-d\TH:i', strtotime($shipment->etd))) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                           @error('etd') border-red-500 @enderror">
                    @error('etd')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ETA -->
                <div>
                    <label for="eta" class="block text-sm font-medium text-gray-700">ETA (Estimated Time of Arrival)</label>
                    <input type="datetime-local" name="eta" id="eta"
                           value="{{ old('eta', date('Y-m-d\TH:i', strtotime($shipment->eta))) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                           @error('eta') border-red-500 @enderror">
                    @error('eta')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('create-shipment') }}" 
                       class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Update Shipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection