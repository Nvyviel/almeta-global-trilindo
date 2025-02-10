@extends('layouts.main')

@section('title', 'Create Consignee')
@section('component')
    <div class="mx-4">
        <a href="{{ route('consignee') }}" wire:navigate class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-100 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Cancel
        </a>
    </div>
    @livewire('consignee-management')
@endsection