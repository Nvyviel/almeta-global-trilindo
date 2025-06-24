<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleExpired
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip check untuk expired page itu sendiri
        if ($request->routeIs('expired')) {
            return $next($request);
        }

        // Cek apakah user tidak terautentikasi
        if (!Auth::check()) {
            // Untuk AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session expired. Please login again.',
                    'expired' => true,
                    'redirect_url' => route('expired'),
                    'status' => 419
                ], 419);
            }

            // Untuk web requests, redirect ke expired page
            return redirect()->route('expired');
        }

        // Optional: Cek session timeout berdasarkan last activity
        $this->checkSessionTimeout($request);

        return $next($request);
    }

    /**
     * Check if session has timed out
     */
    private function checkSessionTimeout(Request $request)
    {
        $lastActivity = $request->session()->get('last_activity');
        $sessionLifetime = config('session.lifetime') * 60; // Convert minutes to seconds

        if ($lastActivity && (now()->timestamp - $lastActivity->timestamp) > $sessionLifetime) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session expired due to inactivity.',
                    'expired' => true,
                    'redirect_url' => route('expired'),
                    'status' => 419
                ], 419);
            }

            return redirect()->route('expired');
        }

        // Update last activity
        $request->session()->put('last_activity', now());
    }
}
