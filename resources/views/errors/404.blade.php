<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include any additional CSS or meta tags your design requires -->
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-lg w-full bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <span class="p-2 rounded-lg bg-red-50 text-red-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </span>
                    404
                </h1>
                <a href="{{ route('dashboard') }}" class="text-red-600 hover:text-red-800 font-medium text-sm">
                    Return to Dashboard
                </a>
            </div>
        </div>

        <div class="p-6">

            <h2 class="text-2xl font-bold text-gray-800 mb-3 text-center">Page Not Found</h2>
            <p class="text-gray-600 mb-6 text-center">
                The page you are looking for doesn't exist or has been moved.
            </p>

            <div class="flex justify-center">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition duration-200 text-sm mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Go Back
                </a>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm text-gray-500">
                <p>© 2025 PT. ALMETA GLOBAL TRILINDO. All rights reserved.</p>
                <p class="mt-1">Current Time: {{ now()->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
    </div>
</body>

</html>
