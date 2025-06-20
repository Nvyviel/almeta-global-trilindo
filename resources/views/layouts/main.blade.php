<x-app-layout>
    @section('layout')
        <div class="min-h-screen">
            <nav
                class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-sm shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class="text-2xl font-black text-red-700 tracking-tight">ALMETA</div>
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-400 text-sm">
                        Logistics Management
                    </div>
                </div>

                <div class="flex items-center space-x-4" x-data="{ open: false }">
                    <button id="mobile-menu-button" class="md:hidden text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
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
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard') || request()->routeIs('filtering-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('release-order') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('release-order') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-shipping-fast mr-2"></i> Release Order
                        </a>
                        <a href="{{ route('seal') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-lock mr-2"></i> Seal
                        </a>
                        <a href="{{ route('shipping-instruction') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('shipping-instruction') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-file-alt mr-2"></i> Shipping Instruction
                        </a>
                        <a href="{{ route('list-bill') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('list-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-scroll mr-2"></i> Bills
                        </a>

                        @if (Auth::user() && Auth::user()->is_admin)
                            <div class="w-full border-t border-gray-200 my-2"></div>
                            <a href="{{ route('dashboard-admin') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard-admin') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-house-user mr-2"></i> Admin Dashboard
                            </a>
                            <a href="{{ route('create-shipment') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-plus-circle mr-2"></i> Schedule
                            </a>
                            <a href="{{ route('approval-ro') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('approval-ro') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-file-contract mr-2"></i> Approval RO
                            </a>
                            <a href="{{ route('approval-si') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('approval-si') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-ship mr-2"></i> Approval SI
                            </a>
                            <a href="{{ route('activity-seal') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('activity-seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-stamp mr-2"></i> Activity Seal
                            </a>
                            <a href="{{ route('create-bill') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-file-invoice mr-2"></i> Create Bills
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            <div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200">
                <div class="pt-20 md:pt-24 px-4">
                    <nav>
                        @php
                            $linkClass =
                                'flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-200 ease-in-out';
                            $activeLinkClass = 'bg-red-50 text-red-600';
                            $inactiveLinkClass = 'text-gray-600 hover:bg-gray-50 hover:text-red-600';
                        @endphp

                        <div class="space-y-1">
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('dashboard') || request()->routeIs('filtering-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-home mr-3"></i> Dashboard
                            </a>
                            <a href="{{ route('release-order') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('release-order') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-shipping-fast mr-3"></i> Release Order
                            </a>
                            <a href="{{ route('seal') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-lock mr-3"></i> Seal
                            </a>
                            <a href="{{ route('shipping-instruction') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('shipping-instruction') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-file-alt mr-3"></i> Shipping Instruction
                            </a>
                            <a href="{{ route('list-bill') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('list-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-scroll mr-3"></i> Bill
                            </a>


                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="border-t border-gray-200 my-4"></div>

                                <a href="{{ route('dashboard-admin') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('dashboard-admin') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fas fa-house-user mr-3"></i> Admin Dashboard
                                </a>
                                <a href="{{ route('create-shipment') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('create-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fas fa-plus-circle mr-3"></i> Schedule
                                </a>
                                <a href="{{ route('approval-ro') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('approval-ro') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-file-contract mr-3"></i> Approval RO
                                </a>
                                <a href="{{ route('approval-si') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('approval-si') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-ship mr-3"></i> Approval SI
                                </a>
                                <a href="{{ route('activity-seal') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('activity-seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-stamp mr-3"></i> Activity Seal
                                </a>
                                <a href="{{ route('create-bill') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('create-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fa-solid fa-file-invoice mr-3"></i> Create Bills
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>

            <main class="md:ml-64 bg-gray-50 pt-16 min-h-screen flex flex-col">
                <div class="p-6 flex-grow">
                    @yield('component')
                </div>
                <footer class="w-full text-gray-500 py-2 sm:py-2 mt-auto">
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

            document.addEventListener('DOMContentLoaded', initMobileMenu);
            document.addEventListener('livewire:navigated', initMobileMenu);

            function initMobileMenu() {
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    // Hapus event listener lama untuk menghindari duplikasi
                    mobileMenuButton.removeEventListener('click', toggleMobileMenu);
                    // Tambahkan event listener baru
                    mobileMenuButton.addEventListener('click', toggleMobileMenu);

                    // Pastikan menu tertutup saat halaman dimuat/navigasi selesai
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenu.classList.remove('translate-y-16');
                }
            }

            function toggleMobileMenu() {
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenu.classList.contains('-translate-y-full')) {
                    mobileMenu.classList.remove('-translate-y-full');
                    mobileMenu.classList.add('translate-y-16');
                } else {
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenu.classList.remove('translate-y-16');
                }
            }
        </script>
    @endsection
</x-app-layout>
