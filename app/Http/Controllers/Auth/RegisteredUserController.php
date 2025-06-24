<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Store function called.');

        try {
            Log::info('Starting validation.');

            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'company_name' => ['required', 'string', 'uppercase'],
                'company_phone_number' => ['required', 'regex:/^(\+62|0)\d{9,13}$/'],
                'company_location' => ['required', 'string'],
                'company_address' => ['required', 'string'],
                'ktp' => ['required', 'image', 'max:2048'],
                'npwp' => ['required', 'image', 'max:2048'],
                'nib' => ['required', 'image', 'max:2048'],
            ], [
                'email.unique' => 'Email ini sudah terdaftar.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'company_phone_number.regex' => 'Format nomor telepon tidak valid. Gunakan format: +62 atau 0 diikuti 9-13 digit.',
                'ktp.required' => 'File KTP wajib diunggah.',
                'ktp.image' => 'File KTP harus berupa gambar.',
                'ktp.max' => 'Ukuran file KTP maksimal 2MB.',
                'npwp.required' => 'File NPWP wajib diunggah.',
                'npwp.image' => 'File NPWP harus berupa gambar.',
                'npwp.max' => 'Ukuran file NPWP maksimal 2MB.',
                'nib.required' => 'File NIB wajib diunggah.',
                'nib.image' => 'File NIB harus berupa gambar.',
                'nib.max' => 'Ukuran file NIB maksimal 2MB.',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed: ' . json_encode($validator->errors()->all()));
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$request->hasFile('ktp') || !$request->hasFile('npwp') || !$request->hasFile('nib')) {
                Log::error('One or more required files are missing.');
                return back()
                    ->withErrors(['files' => 'Semua file (KTP, NPWP, NIB) wajib diunggah.'])
                    ->withInput();
            }

            // Upload files
            Log::info('Uploading files...');
            try {
                $ktpPath = $request->file('ktp')->store('uploads/ktp', 'public');
                $npwpPath = $request->file('npwp')->store('uploads/npwp', 'public');
                $nibPath = $request->file('nib')->store('uploads/nib', 'public');

                Log::info('All files uploaded successfully');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return back()
                    ->withErrors(['upload' => 'Gagal mengunggah file. Silakan coba lagi.'])
                    ->withInput();
            }

            $isAdmin = User::count() === 0;
            $status = $isAdmin ? 'Approved' : 'Under Verification';

            Log::info('Creating user with status: ' . $status);

            $users = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'company_name' => $request->company_name,
                'company_phone_number' => $request->company_phone_number,
                'company_location' => $request->company_location,
                'company_address' => $request->company_address,
                'ktp' => $ktpPath,
                'npwp' => $npwpPath,
                'nib' => $nibPath,
                'is_admin' => $isAdmin,
                'status' => $status
            ]);

            Log::info('User created with ID: ' . $users->id . ' and user_id: ' . $users->user_id);

            event(new Registered($users));
            Log::info('Event Registered triggered.');

            Auth::login($users);
            Log::info('User logged in.');

            if ($users->is_admin) {
                Log::info('Redirecting to admin dashboard.');
                return redirect()->route('dashboard-admin');
            }

            if ($users->status === 'Under Verification') {
                Log::info('Redirecting to pending view.');
                return redirect()->route('pending-view');
            }

            Log::info('Redirecting to user dashboard.');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error('Error in store function: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.'])
                ->withInput();
        }
    }

    public function pendingUser()
    {
        return view('user.landings.pending-view');
    }
}