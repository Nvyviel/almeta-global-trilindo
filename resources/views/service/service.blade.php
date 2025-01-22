@extends('layouts.main')
@section('component')
      <div class="container mx-auto max-w-md">
        <h1 class="text-2xl font-bold mb-6">Input Form</h1>
        <form class="bg-white p-6 rounded shadow-md">
            <!-- Quantity Input -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Total Input -->
            <div class="mb-4">
                <label for="total" class="block text-gray-700 font-bold mb-2">Total</label>
                <input type="number" id="total" name="total" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Price Input -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" id="price" name="price" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection