<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user memiliki session yang aktif
        if (!Auth::check()) {
            // Jika tidak ada session, redirect ke halaman login
            return redirect()->route('login');
        }

        // Cek apakah session sudah expired
        if (session()->has('last_activity')) {
            $lastActivity = session()->get('last_activity');
            $sessionTimeout = config('session.lifetime') * 60; // Konversi menit ke detik

            if (time() - $lastActivity > $sessionTimeout) {
                // Session expired, hapus session dan redirect ke login
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
