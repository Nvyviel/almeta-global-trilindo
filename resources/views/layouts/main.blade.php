<x-app-layout>
    @section('layout')
    <div class="min-h-screen bg-gray-50">
        <!-- Main Navbar -->
        <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-40 px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="text-2xl font-black text-red-600 tracking-tight">ALMETA</div>
                <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-400 text-sm">
                    Logistics Management
                </div>
            </div>
            
            <!-- Profile Dropdown -->
            <div class="flex items-center space-x-4">
                <button id="mobile-menu-button" class="md:hidden text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="relative">
                    <button 
                        id="dropdownToggle"
                        class="flex items-center space-x-2 focus:outline-none"
                    >
                        <div class="relative">
                            <img 
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->company_name) }}&background=0D8AFD&color=fff" 
                                alt="{{ Auth::user()->company_name }}" 
                                class="w-10 h-10 rounded-full border-2 border-red   -500"
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
                            <a href="{{ route('consignee') }}" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i class="fas fa-users mr-3"></i> Consignee
                            </a>
                        </div>
                        <div class="border-t border-gray-200 py-1">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button 
                                    type="button" 
                                    onclick="confirmLogout()"
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
        <div id="mobile-menu" class="md:hidden fixed w-full bg-blue-800 z-30 shadow-md transform transition-transform duration-300 -translate-y-full">
            <div class="px-4 py-3">
                <nav class="flex flex-wrap gap-2">
                    @php
                        $mobileLinkClass = "flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 ease-in-out";
                        $mobileActiveLinkClass = "bg-blue-700 text-white";
                        $mobileInactiveLinkClass = "text-blue-200 hover:bg-blue-700 hover:text-white";
                    @endphp

                    <a href="{{ route('dashboard') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('release-order') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('release-order') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                        <i class="fas fa-shipping-fast mr-2"></i> Release Order
                    </a>
                    <a href="{{ route('shipping-instruction') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('shipping-instruction') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                        <i class="fas fa-file-alt mr-2"></i> Shipping Instruction
                    </a>
                    <a href="#" class="{{ $mobileLinkClass }} {{ $mobileInactiveLinkClass }}">
                        <i class="fas fa-scroll mr-2"></i> Bill of Lading
                    </a>
                    <a href="#" class="{{ $mobileLinkClass }} {{ $mobileInactiveLinkClass }}">
                        <i class="fas fa-truck mr-2"></i> Transaction Order
                    </a>
                    <a href="{{ route('seal') }}" class="{{ $mobileLinkClass }} {{ $mobileInactiveLinkClass }}">
                        <i class="fas fa-lock mr-2"></i> Seal
                    </a>

                    @if(Auth::user() && Auth::user()->is_admin)
                        <div class="w-full border-t border-blue-700 my-2"></div>
                        <a href="{{ route('dashboard-admin') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard-admin') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                        </a>
                        <a href="{{ route('create-shipment') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('create-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-plus-circle mr-2"></i> Create Shipment
                        </a>
                        <a href="{{ route('approval-list') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('approval') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-check-circle mr-2"></i> Approval
                        </a>
                    @endif
                </nav>
            </div>
        </div>
        
        <!-- Desktop Sidebar (Visible on medium and larger screens) -->
        <div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-blue-800 text-white">
            <div class="pt-20 md:pt-24 px-4">
                <div class="mb-8 text-center">
                    <div class="text-2xl font-bold text-white tracking-wider">Customer</div>
                    <div class="text-xs text-blue-300">Relationship Management</div>
                </div>
                
                <nav>
                    @php
                        $linkClass = "flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 ease-in-out";
                        $activeLinkClass = "bg-blue-700 text-white";
                        $inactiveLinkClass = "hover:bg-blue-700 text-blue-200 hover:text-white";
                    @endphp
                    
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="{{ $linkClass }} {{ request()->routeIs('dashboard') ? $activeLinkClass : $inactiveLinkClass }}">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                        <a href="{{ route('release-order') }}" class="{{ $linkClass }} {{ request()->routeIs('release-order') ? $activeLinkClass : $inactiveLinkClass }}">
                            <i class="fas fa-shipping-fast mr-3"></i> Release Order
                        </a>
                        <a href="{{ route('shipping-instruction') }}" class="{{ $linkClass }} {{ request()->routeIs('shipping-instruction') ? $activeLinkClass : $inactiveLinkClass }}">
                            <i class="fas fa-file-alt mr-3"></i> Shipping Instruction
                        </a>
                        <a href="#" class="{{ $linkClass }} {{ $inactiveLinkClass }}">
                            <i class="fas fa-scroll mr-3"></i> Bill of Lading
                        </a>
                        <a href="#" class="{{ $linkClass }} {{ $inactiveLinkClass }}">
                            <i class="fas fa-truck mr-3"></i> Transaction Order
                        </a>
                        <a href="{{ route('seal') }}" class="{{ $linkClass }} {{ $inactiveLinkClass }}">
                            <i class="fas fa-lock mr-3"></i> Seal
                        </a>
                        
                        @if(Auth::user() && Auth::user()->is_admin)
                            <div class="border-t border-blue-700 my-4"></div>
                            <div class="text-xs text-blue-300 px-4 mb-2">ADMIN SECTION</div>
                            
                            <a href="{{ route('dashboard-admin') }}" class="{{ $linkClass }} {{ request()->routeIs('dashboard-admin') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-tachometer-alt mr-3"></i> Admin Dashboard
                            </a>
                            <a href="{{ route('create-shipment') }}" class="{{ $linkClass }} {{ request()->routeIs('create-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-plus-circle mr-3"></i> Create Schedule
                            </a>
                            <a href="{{ route('approval-list') }}" class="{{ $linkClass }} {{ request()->routeIs('approval-list') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-check-circle mr-3"></i> Approval
                            </a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <main class="bg-gray-50 md:ml-64 pt-16 min-h-screen">
            <div class="p-6">
                @yield('component')
            </div>
        </main>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('dropdownToggle');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            let mobileMenuOpen = false;

            // Toggle dropdown
            dropdownToggle.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Mobile menu toggle
            mobileMenuButton.addEventListener('click', function() {
                mobileMenuOpen = !mobileMenuOpen;
                mobileMenu.style.transform = mobileMenuOpen ? 'translateY(56px)' : 'translateY(-100%)';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownToggle.contains(event.target) && 
                    !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Close mobile menu on window resize if screen becomes larger
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768 && mobileMenuOpen) {
                    mobileMenuOpen = false;
                    mobileMenu.style.transform = 'translateY(-100%)';
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