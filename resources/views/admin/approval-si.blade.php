@extends('layouts.main')

@section('component')
    <div class="container mx-auto px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Shipping Instruction Approval</h1>
            <p class="text-sm text-gray-600">Manage shipping instruction approval requests</p>
        </div>

        @if ($shippingInstructions->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-500">No pending shipping instructions to approve</p>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($shippingInstructions as $si)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">
                                    Container #{{ $si->no_container }}
                                </h2>
                                <p class="text-sm text-gray-500">
                                    Submitted {{ $si->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                {{ $si->status }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Company</label>
                                    <p class="text-gray-800">{{ $si->user->company_name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Consignee</label>
                                    <p class="text-gray-800">{{ $si->consignee->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Seal Number</label>
                                    <p class="text-gray-800">{{ $si->no_seal }}</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Container Details</label>
                                    <p class="text-gray-800">{{ $si->container->type }} - {{ $si->container->size }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Shipment Schedule</label>
                                    <p class="text-gray-800">
                                        {{ $si->shipment->vessel_name }} -
                                        {{ \Carbon\Carbon::parse($si->shipment->etd)->format('d M Y') }}
                                    </p>
                                </div>
                                @if ($si->note)
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Notes</label>
                                        <p class="text-gray-800">{{ $si->note }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($si->{'upload-file'})
                            <div class="mt-4">
                                <label class="text-sm font-medium text-gray-500">Attached Document</label>
                                <div class="mt-1">
                                    <a href="{{ Storage::url($si->{'upload-file'}) }}" target="_blank"
                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500">
                                        <i class="fas fa-file-pdf mr-2"></i>
                                        View Document
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <form action="{{ route('rejected-si', $si->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to reject this shipping instruction?')"
                                    class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-500 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-150">
                                    Reject
                                </button>
                            </form>

                            <form action="{{ route('approved-si', $si->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors duration-150">
                                    Approve
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
