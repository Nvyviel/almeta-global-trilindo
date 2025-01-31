<x-app-layout>
        @section('layout')
        <div class="flex min-h-screen bg-gray-50">
            <!-- Navbar -->
            <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}">
                        <div class="text-2xl font-black text-red-600 tracking-tight">ALMETA</div>
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-500">
                        Logistics Management
                    </div>
                </div>
                
                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button 
                            id="dropdownToggle"
                            class="flex items-center space-x-2 focus:outline-none"
                        >
                            <div class="relative">
                                <img 
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->company_name) }}&background=0D8AFD&color=fff" 
                                    alt="{{ Auth::user()->company_name }}" 
                                    class="w-10 h-10 rounded-full border-2 border-blue-500"
                                >
                                @if(!Auth::user()->is_admin)
                                    <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full ring-2 ring-white bg-yellow-500"></span>
                                @endif
                            </div>
                            <div class="hidden md:block">
                                <div class="text-sm font-medium text-gray-700">
                                    {{ Auth::user()->company_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->is_admin ? 'Administrator' : 'User' }}
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 ml-2"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div 
                            id="dropdownMenu"
                            class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden"
                        >
                            <div class="px-4 py-3 bg-gray-50 border-b">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->company_name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile-edit') }}" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-user mr-3"></i> Profile
                                </a>
                                <a href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-cog mr-3"></i> Settings
                                </a>
                            </div>
                            <div class="border-t border-gray-200 py-1">
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button 
                                        type="button" 
                                        onclick="confirmLogout()"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center"
                                    >
                                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content Area -->
            <main class="flex-1 bg-gray-50 pt-28 min-h-screen">
                <div>
                    @yield('component')
                </div>
            </main>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownToggle = document.getElementById('dropdownToggle');
                const dropdownMenu = document.getElementById('dropdownMenu');

                // Toggle dropdown
                dropdownToggle.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent event from bubbling
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdownToggle.contains(event.target) && 
                        !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            });

            function confirmLogout() {
                Swal.fire({
                    title: 'Log Out',
                    text: 'Are you sure you want to log out?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Log Out',
                    confirmButtonColor: "#dc3545",
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: "#3498db",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>
        @endsection
    </x-app-layout>
