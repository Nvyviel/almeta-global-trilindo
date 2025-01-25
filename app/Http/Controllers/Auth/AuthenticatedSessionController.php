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


    public function isadmin(User $user)
    {
        // Hanya izinkan perubahan jika pengguna saat ini adalah super admin (ID 1)
        // dan bukan mengubah akun super admin
        if (auth()->user()->id === 1 && $user->id !== 1) {
            $user->is_admin = !$user->is_admin;
            $user->save();
        }

        return back()->with('status', 'Status admin berhasil diubah');
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

    public function roomAdmin(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%")
                ->orWhere('company_name', 'like', "%{$searchTerm}%")
                ->orWhere('company_location', 'like', "%{$searchTerm}%");
            });
        }

        $users = $query->paginate(5);

        return view('admin.dashboard-admin', compact('users'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.detail-user', compact('user'));
    }
}
