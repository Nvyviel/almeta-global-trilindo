@extends('layouts.main')

@section('component')
  <!-- Navbar -->
  <nav>
    <div class="container-fluid mx-auto flex items-left shadow-lg p-8 space-x-20">
      <!-- Logo -->
     <a href="#" class="text-lg font-bold">
        <span class="text-red-600 text-1xl">ALMETA GLOBAL</span>
        <span class="text-blue-600 text-1xl">TRILINDO</span>
    </a>

      <!-- Menu Items -->
      <ul class="flex space-x-5">
        <li><a href="#" class="text-lg">Home</a></li>
        <li><a href="#" class="text-lg">About</a></li>
        <li><a href="#" class="text-lg">Services</a></li>
        <li><a href="#" class="text-lg">Routes</a></li>
        <li><a href="{{ 'register' }}" class="text-lg">Register</a></li>
        <li><a href="{{ 'login' }}" class="text-lg">Login</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main content -->
<div class="flex justify-between">
  <div class="container mx-auto mt-10">
    <img src="assets/img/AGT-IMG-1.webp" width="20%">
  </div>
    {{-- TRACK --}}
    <div class="items-center">
    <label for="shipping-method">Schedule</label>
    <select id="shipping-method" name="shipping-method">
        <option value="air">Air Freight</option>
        <option value="sea">Sea Freight</option>
        <option value="land">Land Freight</option>
        <option value="express">Express Delivery</option>
    </select>
    </div>
  </div>
</div>
@endsection