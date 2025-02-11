<x-app-layout>
    @section('layout')
        <div class="min-h-screen">
            <!-- Main Navbar -->
            <nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-sm shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class="text-2xl font-black text-red-700 tracking-tight">ALMETA</div>
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-400 text-sm">
                        Logistics Management
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4" x-data="{ open: false }">
                    <button id="mobile-menu-button" class="md:hidden text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="relative">
                                <div
                                    class="w-10 h-10 rounded-full border-2 border-red-700 flex items-center justify-center bg-red-600">
                                    <i class="fas fa-bell text-white"></i>
                                </div>
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

            <!-- Mobile Navigation (Visible on small screens) -->
            <div id="mobile-menu"
                class="md:hidden fixed w-full bg-white z-30 shadow-md transform transition-transform duration-300 -translate-y-full">
                <div class="px-4 py-3">
                    <nav class="flex flex-wrap gap-2">
                        @php
                            $mobileLinkClass =
                                'flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 ease-in-out';
                            $mobileActiveLinkClass = 'bg-gray-100 text-red-600';
                            $mobileInactiveLinkClass = 'text-gray-600 hover:bg-gray-50 hover:text-red-600';
                        @endphp

                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('release-order') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('release-order') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-shipping-fast mr-2"></i> Release Order
                        </a>
                        <a href="{{ route('shipping-instruction') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('shipping-instruction') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-file-alt mr-2"></i> Shipping Instruction
                        </a>
                        <a href="{{ route('list-bill') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('list-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-scroll mr-2"></i> Bill of Lading
                        </a>
                        <a href="{{ route('seal') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-lock mr-2"></i> Seal
                        </a>

                        @if (Auth::user() && Auth::user()->is_admin)
                            <div class="w-full border-t border-gray-200 my-2"></div>
                            <a href="{{ route('dashboard-admin') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard-admin') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-house-user mr-2"></i> Admin Dashboard
                            </a>
                            <a href="{{ route('create-shipment') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-plus-circle mr-2"></i> Create Schedule
                            </a>
                            <a href="{{ route('approval-ro') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('approval-ro') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-file-contract mr-2"></i> Approval Release Order
                            </a>
                            <a href="{{ route('approval-si') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('approval-si') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-ship mr-2"></i> Shipping Instruction
                            </a>
                            <a href="{{ route('activity-seal') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('activity-seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-stamp mr-2"></i> Activity Seal
                            </a>
                            <a href="{{ route('create-bill') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-file-invoice mr-2"></i> Create Bill of Lading
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            <!-- Desktop Sidebar (Visible on medium and larger screens) -->
            <div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200">
                <div class="pt-20 md:pt-24 px-4">
                    <div class="mb-8 text-center">
                        <div class="text-2xl font-bold text-gray-800 tracking-wider">Customer</div>
                        <div class="text-xs text-gray-500">Relationship Management</div>
                    </div>
                    <div class="border-t border-gray-200 my-4"></div>
                    <nav>
                        @php
                            $linkClass =
                                'flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-200 ease-in-out';
                            $activeLinkClass = 'bg-red-50 text-red-600';
                            $inactiveLinkClass = 'text-gray-600 hover:bg-gray-50 hover:text-red-600';
                        @endphp

                        <div class="space-y-1">
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('dashboard') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-home mr-3"></i> Dashboard
                            </a>
                            <a href="{{ route('release-order') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('release-order') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-shipping-fast mr-3"></i> Release Order
                            </a>
                            <a href="{{ route('shipping-instruction') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('shipping-instruction') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-file-alt mr-3"></i> Shipping Instruction
                            </a>
                            <a href="{{ route('list-bill') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('list-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-scroll mr-3"></i> Bill of Lading
                            </a>
                            <a href="{{ route('seal') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-lock mr-3"></i> Seal
                            </a>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="border-t border-gray-200 my-4"></div>
                                <div class="text-xs text-gray-400 px-4 mb-2">ADMIN SECTION</div>

                                <a href="{{ route('dashboard-admin') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('dashboard-admin') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fas fa-house-user mr-3"></i> Admin Dashboard
                                </a>
                                <a href="{{ route('create-shipment') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('create-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fas fa-plus-circle mr-3"></i> Create Schedule
                                </a>
                                <a href="{{ route('approval-ro') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('approval-ro') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-file-contract mr-3"></i> Approval Release Order
                                </a>
                                <a href="{{ route('approval-si') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('approval-si') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-ship mr-3"></i> Shipping Instruction
                                </a>
                                <a href="{{ route('activity-seal') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('activity-seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-stamp mr-3"></i> Activity Seal
                                </a>
                                <a href="{{ route('create-bill') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('create-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-file-invoice mr-3"></i> Create Bill of Lading
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <main class="md:ml-64 bg-gray-50 pt-16 min-h-screen">
                <div class="p-6">
                    @yield('component')
                </div>
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
