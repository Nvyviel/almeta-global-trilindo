<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Public routes that should be accessible without authentication
        $publicRoutes = [
            '/',
            'filtering-shipment',
            'login',
            'register',
            'password/*',
        ];

        // Check if the current route is a public route
        foreach ($publicRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        // Handle booking routes specifically
        if ($request->is('*/booking/*') || $request->is('*/booking')) {
            if (!auth()->check()) {
                // Store the intended URL in the session
                session()->put('url.intended', $request->url());

                // Redirect to login with a message
                return redirect()->route('login')
                    ->with('warning', 'Please login first to book a shipment.');
            }
        }

        // For all other routes, check authentication
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('warning', 'Please login to access this page.');
        }

        return $next($request);
    }
}
