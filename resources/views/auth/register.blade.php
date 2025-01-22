<x-guest-layout>
    <div class="flex justify-center items-center mb-6">
        <img src="assets/img/AGT-IMG-1.webp" width="15%" alt="Logo">
    </div>

    <form 
        method="POST" 
        action="{{ route('register') }}" 
        class="rounded-lg"
        enctype="multipart/form-data">
        
        @csrf
        <h1 class="text-center text-3xl font-bold text-slate-900 mb-4">Register</h1>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                   required 
                   placeholder="Enter your email">
        </div>

        <!-- Name -->
        <div class="mt-4">
            <label for="name" class="block font-medium text-gray-700">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   x-model="name" 
                   class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                   required 
                   placeholder="Enter your full name">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-gray-700">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none"  
                   required 
                   placeholder="Enter your password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   x-model="confirmPassword"
                   class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                   required 
                   placeholder="Confirm your password">
        </div>

        <!-- Business Type -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-2">Business Type</h2>
            <div class="flex space-x-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="isIndividual" class="rounded border-gray-300 text-blue-600 focus:ring-blue-300">
                    <span class="ml-2 text-gray-600">Individual</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="isCompany" class="rounded border-gray-300 text-blue-600 focus:ring-blue-300">
                    <span class="ml-2 text-gray-600">Company</span>
                </label>
            </div>
        </div>

        <!-- Company Information -->
        <div class="mt-6">
            <label for="company_name" class="block font-medium text-gray-700">Company Name</label>
            <input id="company_name" 
                   type="text" 
                   name="company_name" 
                   class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none" 
                   required 
                   placeholder="Enter your company name">
                   @error('company_name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                   @enderror
        </div>
        <div class="mt-6">
                <label for="company_phone_number" class="block font-medium text-gray-700">Company Phone Number</label>
                <input id="company_phone_number" 
                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                    type="number" 
                    name="company_phone_number" 
                    value="{{ old('company_phone_number') }}"
                    required autocomplete="phone" 
                    placeholder="Enter your company phone number">
                    @error('company_phone')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mt-6">
                <label for="company_location" class="block font-medium text-gray-700">Company Location</label>
                <input id="company_location" 
                    class="block w-full mt-1 h-10 p-2 border rounded-md shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none"
                    type="text" 
                    name="company_location" 
                    value="{{ old('company_location') }}" 
                    required autocomplete="location" 
                    placeholder="Enter your company location">
                @error('company_location')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-6">
                <label for="company_address" class="block font-medium text-gray-700">Company Address</label>
                <textarea id="company_address" 
                        placeholder="Enter your company address" 
                        class="w-full resize-none h-28 mt-1 p-2 block rounded-md border shadow-sm focus:border-blue-400 focus:ring-blue-300 focus:outline-none" name="company_address"></textarea>
                @error('company_address')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

        <!-- Documents -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-2">Documents</h2>
            <div class="mt-4">
                <label class="block text-sm font-medium">Upload KTP:</label>
                <input type="file" accept="image/*" class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" name="ktp">
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium">Upload NPWP:</label>
                <input type="file" accept="image/*" class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" name="npwp">
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium">Upload NIB:</label>
                <input type="file" accept="image/*" class="block w-full mt-2 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" name="nib">
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-800">Already registered? Login</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">
                Register
            </button>
        </div>
    </form>
</div>
</x-guest-layout>