<x-app-layout>
    @section('layout')
        <div class="flex min-h-screen">
            <!-- Navbar -->
            <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class="text-2xl font-black text-red-600 tracking-tight">ALMETA</div>
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-400 text-sm">
                        Logistics Management
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4" x-data="{ open: false }">
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="relative">
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
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->company_name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile-edit') }}" wire:navigate
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-user mr-3"></i> Profile
                                </a>
                                <a href="{{ route('consignee') }}" wire:navigate
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-users mr-3"></i> Consignee
                                </a>
                            </div>
                            <div class="border-t border-gray-200 py-1">
                                <form method="POST" action="{{ route('logout') }}" wire:navigate id="logout-form">
                                    @csrf
                                    <button type="button" onclick="confirmLogout()"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
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
                <footer class="relative z-10 text-gray-500 py-2 sm:py-2">
                    <div class="pt-3 sm:pt-2 text-center">
                        <p class="text-sm sm:text-base text-gray-500">Powered by PT. ALMETA GLOBAL TRILINDO</p>
                        <p class="text-xs sm:text-sm text-gray-500 mt-2">&copy; 2025 All rights reserved.</p>
                    </div>
                </footer>
            </main>
        </div>

        <script>
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
