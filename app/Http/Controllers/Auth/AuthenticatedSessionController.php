<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Shipment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function login()
    {
        return view('auth.login');
    }


    public function isadmin(Request $request, User $user)
    {
        $user->is_admin = $request->has('is_admin');
        $user->save();
        return back();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // First check if the email exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak terdaftar.'])
                ->withInput();
        }

        // Then attempt to authenticate
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->back()
                ->withErrors(['password' => 'Password yang anda masukkan salah.'])
                ->withInput();
        }

        // Regenerate the session for security
        $request->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect()->route('dashboard-admin');
        }
        return redirect()->route('dashboard');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function roomAdmin()
    {
        $users = User::all();
        return view('admin.dashboard-admin', compact('users'));
    }
}
