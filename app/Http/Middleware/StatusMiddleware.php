<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StatusMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('=== StatusMiddleware START ===');
        Log::info('StatusMiddleware: Current URL: ' . $request->url());
        Log::info('StatusMiddleware: Current Path: ' . $request->path());

        if ($request->routeIs('login') || $request->routeIs('register') || $request->routeIs('logout')) {
            Log::info('StatusMiddleware: Skipping auth routes');
            return $next($request);
        }

        if (!Auth::check()) {
            Log::info('StatusMiddleware: User not authenticated, redirecting to login');
            return redirect()->route('login');
        }

        $user = Auth::user();
        Log::info('StatusMiddleware: User ID: ' . $user->id);
        Log::info('StatusMiddleware: User status: ' . $user->status);
        Log::info('StatusMiddleware: Is admin: ' . ($user->is_admin ? 'true' : 'false'));

        $currentRoute = $request->route() ? $request->route()->getName() : 'NO_ROUTE_NAME';
        Log::info('StatusMiddleware: Current route name: ' . $currentRoute);

        if ($user->is_admin) {
            Log::info('StatusMiddleware: User is admin, allowing access');
            return $next($request);
        }

        if ($user->status === 'Approved') {
            Log::info('StatusMiddleware: User status is Approved');
            if ($request->routeIs('pending-view')) {
                Log::info('StatusMiddleware: Redirecting approved user from pending-view to dashboard');
                return redirect()->route('dashboard');
            }
            Log::info('StatusMiddleware: Allowing approved user to continue');
            return $next($request);
        }

        if ($user->status === 'Under Verification' || $user->status === 'Warned') {
            Log::info('StatusMiddleware: User has restricted status: ' . $user->status);

            $allowedRoutes = ['pending-view', 'landing-page', 'update-document'];
            Log::info('StatusMiddleware: Allowed routes: ' . implode(', ', $allowedRoutes));
            Log::info('StatusMiddleware: Checking if current route is allowed...');

            if ($request->routeIs('pending-view')) {
                Log::info('StatusMiddleware: Route pending-view is allowed');
                return $next($request);
            } elseif ($request->routeIs('landing-page')) {
                Log::info('StatusMiddleware: Route landing-page is allowed');
                return $next($request);
            } elseif ($request->routeIs('update-document')) {
                Log::info('StatusMiddleware: Route update-document is allowed');
                return $next($request);
            } else {
                Log::info('StatusMiddleware: Route NOT allowed, redirecting to pending-view');
                Log::info('StatusMiddleware: REDIRECTING FROM: ' . $currentRoute . ' TO: pending-view');
                return redirect()->route('pending-view')->with('warning', 'Akses terbatas. Status akun Anda: ' . $user->status);
            }
        }

        Log::info('StatusMiddleware: No status match, redirecting to login');
        return redirect()->route('login');
    }
}