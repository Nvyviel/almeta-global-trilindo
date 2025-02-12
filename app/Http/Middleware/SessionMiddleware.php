<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user memiliki session yang aktif
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah session sudah expired
        if (session()->has('last_activity')) {
            $lastActivity = session()->get('last_activity');
            $sessionTimeout = config('session.lifetime') * 60; // Konversi menit ke detik

            if (time() - $lastActivity > $sessionTimeout) {
                Auth::logout();
                session()->flush();
                return redirect()->route('login')->with('message', 'Session Anda telah berakhir. Silakan login kembali.');
            }
        }

        // Update waktu aktivitas terakhir
        session()->put('last_activity', time());

        return $next($request);
    }
}
