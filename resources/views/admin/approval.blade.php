@extends('layouts.main')

@section('component')
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <!-- Card Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
                <!-- Approval Release Order -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 flex flex-col h-full border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Release Order</h2>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">Manage and approve release orders efficiently with our streamlined approval system.</p>
                    <div class="mt-auto">
                        <a href="{{ route('approval-ro') }}" wire:navigate class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300 w-full sm:w-auto">
                            Manage RO
                            <i class="fa-solid fa-arrow-right-long ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Approval Seal -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 flex flex-col h-full border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Seal</h2>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">Review and approve seal requests with our secure verification process.</p>
                    <div class="mt-auto">
                        <a href="{{ route('activity-seal') }}" wire:navigate class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors duration-300 w-full sm:w-auto">
                            Manage Seals
                            <i class="fa-solid fa-arrow-right-long ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Approval Shipping Instruction -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 flex flex-col h-full border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Shipping Instruction</h2>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">Approve shipping instructions and ensure smooth logistics operations.</p>
                    <div class="mt-auto">
                        <a href="{{ route('approval-si') }}" wire:navigate class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 transition-colors duration-300 w-full sm:w-auto">
                            Manage SI
                            <i class="fa-solid fa-arrow-right-long ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Approval Bill of Lading -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 flex flex-col h-full border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Bill of Lading</h2>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">Review and approve Bills of Lading with comprehensive validation.</p>
                    <div class="mt-auto">
                        <a href="#" wire:navigate class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 transition-colors duration-300 w-full sm:w-auto">
                            Manage BL
                            <i class="fa-solid fa-arrow-right-long ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection