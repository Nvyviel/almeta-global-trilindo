<x-guest-layout>
    @section('title-guest', 'Login')

    {{-- Notification Section --}}
    @if ($errors->any())
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div
                class="mx-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-700 hover:text-red-900 focus:outline-none">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div
                class="mx-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="mt-2 list-disc list-inside">
                            {{ session('success') }}
                        </span>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-green-700 hover:text-green-900 focus:outline-none">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-b from-blue-500/10 to-purple-500/5 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-t from-blue-500/5 to-transparent -z-10"></div>
        <div class="absolute top-20 left-20 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl -z-10"></div>

        <!-- Grid pattern background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.015] -z-10"></div>

        <!-- Content Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-6xl grid md:grid-cols-5 bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Left Column - Decorative Side -->
                <div
                    class="md:col-span-2 bg-gradient-to-br from-blue-600 to-indigo-700 p-8 relative hidden md:block overflow-hidden">
                    <!-- Decorative circles -->
                    <div class="absolute top-10 right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                    <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white/10 rounded-full"></div>
                    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-white/10 rounded-full"></div>

                    <!-- Content -->
                    <div class="relative h-full flex flex-col justify-between text-white z-10">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">ALMETA GLOBAL</h2>
                            <div class="w-12 h-1 bg-white/50 mb-6"></div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-3xl font-bold leading-tight">Seamless Shipping Solutions For Your Business
                            </h3>
                            <p class="text-white/90">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                                venenatis felis ac magna porttitor, nec placerat nisi dignissim.</p>

                            <!-- Testimonial -->
                            <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm mt-8">
                                <p class="italic text-white/80 text-sm mb-3">"Vestibulum ante ipsum primis in faucibus
                                    orci luctus et ultrices posuere cubilia curae; Mauris at ex vel justo."</p>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">PT</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Pacific Trading</p>
                                        <p class="text-xs text-white/70">Client since 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-sm text-white/50">
                            &copy; {{ date('Y') }} Almeta Global Trilindo
                        </div>
                    </div>
                </div>

                <!-- Right Column - Form Side -->
                <div class="md:col-span-3 p-8 md:p-12 flex flex-col justify-center">
                    <div class="max-w-md w-full mx-auto">
                        <div class="text-center mb-8">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Welcome Back</h1>
                            <p class="text-gray-600 mt-2">Please sign in to access your account</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            {{-- Email --}}
                            <div class="group">
                                <label for="email" class="block font-medium text-gray-700 text-sm mb-2 ml-1">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm 
                                            @error('email') border-red-500 @enderror 
                                            focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                        required placeholder="example@gmail.com">
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="group">
                                <label for="password"
                                    class="block font-medium text-gray-700 text-sm mb-2 ml-1">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                    <input id="password" type="password" name="password"
                                        class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                            @error('password') border-red-500 @enderror 
                                            focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                        required placeholder="••••••">
                                </div>
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                    class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm 
                                        focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                        hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                        transition-all duration-300 transform hover:-translate-y-0.5">
                                    Sign In
                                </button>
                            </div>

                            {{-- Links --}}
                            <div
                                class="flex flex-col sm:flex-row items-center justify-between pt-2 space-y-3 sm:space-y-0">
                                <a href="{{ route('register') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    Don't have an account? <span class="font-semibold">Register</span>
                                </a>
                                <a href="{{ route('password.request') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    Forgot your password?
                                </a>
                            </div>
                        </form>

                        <!-- Social Login Divider -->
                        <div class="my-8 flex items-center">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <div class="px-4 text-sm text-gray-500">or continue with</div>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="flex gap-4 justify-center">
                            <button
                                class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 2C6.477 2 2 6.477 2 12C2 16.991 5.657 21.128 10.438 21.879V14.89H7.898V12H10.438V9.797C10.438 7.291 11.93 5.907 14.215 5.907C15.309 5.907 16.453 6.102 16.453 6.102V8.562H15.193C13.95 8.562 13.563 9.333 13.563 10.124V12H16.336L15.893 14.89H13.563V21.879C18.343 21.129 22 16.99 22 12C22 6.477 17.523 2 12 2Z"
                                        fill="#1877F2" />
                                </svg>
                            </button>
                            <button
                                class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.8055 10.0415H12V14.0415H17.6515C17.2555 15.1915 16.337 16.0675 15.1 16.5895L18.025 18.8515C20.062 17.035 21.625 14.2635 21.625 10.8885C21.625 10.5995 21.6155 10.3155 21.5975 10.0415H21.8055Z"
                                        fill="#4285F4" />
                                    <path
                                        d="M12 22C14.9 22 17.35 21.0115 19.0045 19.361L16.0795 17.099C15.2375 17.6678 13.7144 18 12 18C9.3565 18 7.09 16.3085 6.173 14.0415L3.13 16.2635C4.359 18.1135 6.552 22 12 22Z"
                                        fill="#34A853" />
                                    <path
                                        d="M6.173 14.0415C5.904 13.3515 5.77 12.691 5.77 12C5.77 11.309 5.908 10.6225 6.1745 9.9585L3.138 7.7365C2.513 9.0055 2.25 10.4735 2.25 12C2.25 13.5265 2.513 14.9945 3.138 16.2635L6.173 14.0415Z"
                                        fill="#FBBC05" />
                                    <path
                                        d="M12 5.77C13.6075 5.77 15.0615 6.3345 16.184 7.391L18.773 4.8025C17.0225 3.1725 14.9 2 12 2C6.552 2 4.359 5.8865 3.138 7.7365L6.174 9.9585C7.091 7.6915 9.3565 5.77 12 5.77Z"
                                        fill="#EA4335" />
                                </svg>
                            </button>
                            <button
                                class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.318 14.045C17.27 14.044 17.223 14.043 17.173 14.043C16.124 14.043 15.262 13.149 15.262 12.058C15.262 10.967 16.127 10.074 17.176 10.074H17.182C18.238 10.074 19.1 10.967 19.1 12.058C19.1 13.149 18.238 14.045 17.318 14.045ZM6.826 14.045C5.929 14.045 5.094 13.174 5.094 12.062C5.094 10.95 5.929 10.078 6.826 10.078C7.723 10.078 8.558 10.95 8.558 12.062C8.558 13.174 7.723 14.045 6.826 14.045ZM20.956 16.836C20.572 17.362 20.124 17.776 19.614 18.074C19.103 18.374 18.538 18.55 17.925 18.602C17.311 18.654 16.705 18.578 16.109 18.378C15.819 18.268 15.553 18.116 15.314 17.924C15.078 17.735 14.867 17.513 14.68 17.266C14.194 17.631 13.654 17.91 13.07 18.093C12.49 18.274 11.881 18.364 11.262 18.361C10.66 18.358 10.066 18.264 9.498 18.083C8.931 17.902 8.409 17.635 7.941 17.286C7.754 17.533 7.543 17.755 7.307 17.944C7.068 18.136 6.802 18.288 6.512 18.398C5.945 18.619 5.371 18.704 4.788 18.652C4.206 18.6 3.673 18.424 3.19 18.124C2.708 17.826 2.288 17.413 1.934 16.885C1.698 16.55 1.558 16.167 1.515 15.737C1.471 15.307 1.524 14.87 1.673 14.428C1.822 13.986 2.06 13.566 2.388 13.167C2.716 12.769 3.119 12.419 3.598 12.118C3.797 11.989 3.884 11.788 3.859 11.515C3.833 11.242 3.807 10.964 3.781 10.681C3.755 10.348 3.746 10.007 3.755 9.659C3.755 9.386 3.782 9.113 3.835 8.843C3.898 8.541 3.989 8.242 4.107 7.946C4.225 7.65 4.365 7.365 4.528 7.093C4.69 6.821 4.87 6.562 5.067 6.317C5.264 6.072 5.473 5.844 5.695 5.632C5.917 5.421 6.147 5.23 6.386 5.061C6.625 4.891 6.87 4.741 7.123 4.612C7.375 4.482 7.631 4.376 7.893 4.292C8.155 4.209 8.419 4.149 8.685 4.115C9.216 4.04 9.74 4.04 10.255 4.115C10.77 4.189 11.263 4.322 11.733 4.513C12.202 4.704 12.637 4.945 13.037 5.235C13.437 5.525 13.794 5.85 14.107 6.21C14.154 6.266 14.2 6.324 14.246 6.388C14.291 6.454 14.336 6.525 14.378 6.598C14.421 6.674 14.463 6.746 14.503 6.817C14.543 6.888 14.582 6.956 14.617 7.022C14.904 6.673 15.227 6.353 15.588 6.063C15.948 5.773 16.341 5.525 16.767 5.318C17.192 5.112 17.639 4.957 18.106 4.852C18.574 4.748 19.054 4.704 19.546 4.722C20.038 4.74 20.523 4.814 21.002 4.943C21.481 5.073 21.937 5.25 22.371 5.476C22.805 5.702 23.2 5.971 23.555 6.284C24.085 6.748 24.49 7.291 24.77 7.913C25.05 8.534 25.19 9.21 25.19 9.94C25.19 10.233 25.164 10.53 25.112 10.831C25.06 11.133 24.983 11.429 24.883 11.719C24.817 11.971 24.73 12.154 24.621 12.267C24.511 12.38 24.368 12.459 24.195 12.506C24.051 12.542 23.924 12.611 23.816 12.714C23.707 12.817 23.625 12.942 23.571 13.09C23.425 13.457 23.203 13.822 22.904 14.185C22.606 14.548 22.26 14.879 21.869 15.177C21.477 15.475 21.05 15.724 20.588 15.924C20.126 16.125 19.662 16.251 19.198 16.304C18.92 16.334 18.668 16.403 18.44 16.512C18.212 16.622 18.018 16.76 17.856 16.928C17.695 17.095 17.578 17.282 17.507 17.488C17.436 17.695 17.423 17.908 17.469 18.128C17.564 18.042 17.687 17.974 17.837 17.922C17.988 17.868 18.14 17.841 18.295 17.841C18.45 17.841 18.597 17.868 18.739 17.922C18.88 17.975 19.002 18.05 19.106 18.147C19.11 18.145 19.114 18.144 19.118 18.143C19.122 18.141 19.126 18.139 19.13 18.137C19.395 17.888 19.634 17.62 19.845 17.335C20.056 17.05 20.241 16.749 20.404 16.422C20.533 16.579 20.656 16.712 20.775 16.823C20.891 16.935 20.943 16.9 20.956 16.836ZM13.184 12.251C13.141 12.166 13.098 12.082 13.054 11.998C12.966 11.831 12.878 11.664 12.787 11.498C12.697 11.333 12.604 11.169 12.509 11.006C12.413 10.843 12.315 10.682 12.213 10.523C12.111 10.364 12.006 10.206 11.898 10.049C11.79 9.892 11.678 9.737 11.563 9.584C11.448 9.431 11.33 9.279 11.208 9.128C11.086 8.977 10.96 8.828 10.832 8.681C10.704 8.534 10.573 8.388 10.438 8.243C10.304 8.098 10.166 7.955 10.026 7.814C9.885 7.673 9.741 7.533 9.594 7.395C9.447 7.257 9.296 7.121 9.142 6.987C9.023 6.88 8.904 6.824 8.785 6.819C8.665 6.814 8.554 6.85 8.451 6.926C8.348 7.002 8.259 7.112 8.183 7.255C8.107 7.399 8.048 7.565 8.007 7.755C7.932 8.096 7.9 8.429 7.911 8.754C7.921 9.079 7.97 9.394 8.056 9.7C8.143 10.005 8.262 10.299 8.414 10.581C8.566 10.862 8.743 11.129 8.944 11.38C9.08 11.545 9.224 11.698 9.378 11.839C9.531 11.981 9.691 12.11 9.857 12.225C10.023 12.341 10.195 12.444 10.372 12.534C10.548 12.624 10.729 12.7 10.914 12.763C11.099 12.826 11.287 12.874 11.478 12.908C11.668 12.941 11.861 12.961 12.055 12.965C12.249 12.97 12.443 12.96 12.637 12.936C12.831 12.912 13.023 12.873 13.212 12.82C13.203 12.63 13.194 12.44 13.184 12.251Z"
                                        fill="black" />
                                </svg>
                            </button>
                        </div>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-10">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced animations -->
    <style>
        /* Background grid pattern */
        .bg-grid-pattern {
            background-size: 20px 20px;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Improved focus styles */
        input:focus,
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
    </style>
</x-guest-layout>
