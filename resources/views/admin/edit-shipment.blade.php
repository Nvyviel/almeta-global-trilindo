@extends('layouts.main')
@section('title', 'Edit Shipment')
@section('component')
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-5 flex items-center text-sm text-gray-500">
                <a href="{{ route('create-shipment') }}" class="hover:text-blue-600 transition-colors">Shipments</a>
                <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="font-medium text-gray-700">Edit Shipment</span>
            </div>

            <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
                <!-- Header -->
                <div class="bg-blue-600 px-6 py-5">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <h2 class="text-xl font-semibold text-white">Edit Shipment Details</h2>
                    </div>
                    <p class="text-blue-100 mt-1">Update the information for shipment: {{ $shipment->vessel_name }}</p>
                </div>

                <!-- Form -->
                <form action="{{ route('update-shipment', $shipment->id) }}" method="POST" class="p-6"
                    id="shipmentForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- From City -->
                        <div>
                            <label for="from_city" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Port of Loading (POL)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-anchor text-gray-400"></i>
                                </div>
                                <select name="from_city" id="from_city"
                                    class="block w-full pl-10 pr-10 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none
                                    @error('from_city') border-red-500 @enderror">
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $key }}"
                                            {{ $shipment->from_city == $key ? 'selected' : '' }}>
                                            {{ $city }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('from_city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- To City -->
                        <div>
                            <label for="to_city" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Port of Discharge (POD)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-anchor text-gray-400"></i>
                                </div>
                                <select name="to_city" id="to_city"
                                    class="block w-full pl-10 pr-10 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none
                                    @error('to_city') border-red-500 @enderror">
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $key }}"
                                            {{ $shipment->to_city == $key ? 'selected' : '' }}>
                                            {{ $city }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('to_city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Vessel Information Section -->
                    <div class="mt-8">
                        <h3 class="text-gray-700 font-medium mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                            </svg>
                            Vessel Information
                            <span class="h-px flex-1 bg-gray-200 ml-3"></span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Vessel Name -->
                            <div>
                                <label for="vessel_name" class="block text-sm font-medium text-gray-700 mb-1">Vessel
                                    Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-ship text-gray-400"></i>
                                    </div>
                                    <input type="text" name="vessel_name" id="vessel_name"
                                        value="{{ old('vessel_name', $shipment->vessel_name) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                    @error('vessel_name') border-red-500 @enderror">
                                </div>
                                @error('vessel_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rate -->
                            <div>
                                <label for="rate" class="block text-sm font-medium text-gray-700 mb-1">Rate Per
                                    Container (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" name="rate" id="rate"
                                        value="{{ old('rate', $shipment->rate) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 thousand-format
                                    @error('rate') border-red-500 @enderror">
                                    <input type="hidden" name="rate_value" id="rate_value"
                                        value="{{ old('rate', $shipment->rate) }}">
                                </div>
                                @error('rate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Information Section -->
                    <div class="mt-8">
                        <h3 class="text-gray-700 font-medium mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Schedule Information
                            <span class="h-px flex-1 bg-gray-200 ml-3"></span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Closing Cargo -->
                            <div>
                                <label for="closing_cargo" class="block text-sm font-medium text-gray-700 mb-1">Closing
                                    Cargo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="closing_cargo" id="closing_cargo"
                                        value="{{ old('closing_cargo', date('Y-m-d\TH:i', strtotime($shipment->closing_cargo))) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                    @error('closing_cargo') border-red-500 @enderror">
                                </div>
                                @error('closing_cargo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ETB -->
                            <div>
                                <label for="etb" class="block text-sm font-medium text-gray-700 mb-1">ETB (Estimated
                                    Time of Berth)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="etb" id="etb"
                                        value="{{ old('etb', date('Y-m-d\TH:i', strtotime($shipment->etb))) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                    @error('etb') border-red-500 @enderror">
                                </div>
                                @error('etb')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ETD -->
                            <div>
                                <label for="etd" class="block text-sm font-medium text-gray-700 mb-1">ETD (Estimated
                                    Time of Departure)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="etd" id="etd"
                                        value="{{ old('etd', date('Y-m-d\TH:i', strtotime($shipment->etd))) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                    @error('etd') border-red-500 @enderror">
                                </div>
                                @error('etd')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ETA -->
                            <div>
                                <label for="eta" class="block text-sm font-medium text-gray-700 mb-1">ETA (Estimated
                                    Time of Arrival)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="eta" id="eta"
                                        value="{{ old('eta', date('Y-m-d\TH:i', strtotime($shipment->eta))) }}"
                                        class="block w-full pl-10 pr-4 py-2.5 text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                    @error('eta') border-red-500 @enderror">
                                </div>
                                @error('eta')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 mt-12 pt-4 border-t border-gray-100">
                        <a href="{{ route('create-shipment') }}" wire:navigate
                            class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Shipment
                        </button>
                    </div>
                </form>
            </div>

            <!-- Last updated info -->
            <div class="mt-4 text-right text-xs text-gray-500">
                Last updated: {{ date('Y-m-d H:i:s', strtotime($shipment->updated_at)) }}
                <br>
                <span>Edited by: Nvyviel</span>
                <span>Date: 2025-03-23 06:53:52</span>
            </div>
        </div>
    </div>

    <!-- Script for thousand separator formatting -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format initial values
            const thousandInputs = document.querySelectorAll('.thousand-format');
            thousandInputs.forEach(input => {
                formatThousand(input);
            });

            // Format on input 
            document.querySelectorAll('.thousand-format').forEach(input => {
                input.addEventListener('input', function() {
                    formatThousand(this);
                });
            });

            // Handle form submission to ensure the server gets the raw number
            document.getElementById('shipmentForm').addEventListener('submit', function(e) {
                const rateInput = document.getElementById('rate');
                const rateValue = document.getElementById('rate_value');

                // Set the hidden field value to the unformatted number
                rateValue.value = rateInput.value.replace(/\./g, '');

                // Update the visible field to show unformatted value for submission
                rateInput.value = rateValue.value;
            });

            function formatThousand(input) {
                // Save cursor position
                const cursorPos = input.selectionStart;

                // Get input value and remove all non-digits
                const value = input.value.replace(/\./g, '');

                // Store original string length for cursor position calculation
                const originalLength = input.value.length;

                if (value === '') {
                    input.value = '';
                    return;
                }

                // Format with thousand separator
                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && (value.length - i) % 3 === 0) {
                        formattedValue += '.';
                    }
                    formattedValue += value[i];
                }

                // Calculate new cursor position
                const newLength = formattedValue.length;
                const addedSeparators = newLength - value.length;

                // Set new value and cursor position
                input.value = formattedValue;

                // Calculate how many separators were before the cursor
                const beforeCursor = input.value.substring(0, cursorPos);
                const separatorsBefore = (beforeCursor.match(/\./g) || []).length;

                // The number of separators that were already in the string before we formatted it
                const previousSeparators = (originalLength - value.length);

                // New separators added specifically before our cursor position
                const newSeparatorsBefore = separatorsBefore - (previousSeparators > 0 ? previousSeparators : 0);

                // Adjust cursor position
                const adjustedCursorPos = Math.min(
                    cursorPos + (newSeparatorsBefore > 0 ? newSeparatorsBefore : 0),
                    formattedValue.length
                );

                input.setSelectionRange(adjustedCursorPos, adjustedCursorPos);

                // Store unformatted value in hidden field
                const hiddenField = document.getElementById(input.id + '_value');
                if (hiddenField) {
                    hiddenField.value = value;
                }
            }
        });
    </script>
@endsection
