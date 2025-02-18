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
        if ($request->routeIs('login') || $request->routeIs('register') || $request->routeIs('logout')) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        Log::info('User status: ' . $user->status);
        Log::info('Current route: ' . $request->route()->getName());

        if ($user->is_admin) {
            return $next($request);
        }

        if ($user->status === 'Approved') {
            if ($request->routeIs('pending-view')) {
                return redirect()->route('dashboard');
            }
            return $next($request);
        }

        if ($user->status === 'Pending' || $user->status === 'Warned') {
            if ($request->routeIs('pending-view') || $request->routeIs('update-document')) {
                return $next($request);
            }
            return redirect()->route('pending-view');
        }

        return redirect()->route('login');
    }
}
