<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profiles.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        // Debug: Log what data is being received
        Log::info('Profile Update Data:', $validated);
        Log::info('User before update:', $user->toArray());

        // Handle file uploads
        if ($request->hasFile('ktp')) {
            // Delete old file if exists
            if ($user->ktp && Storage::disk('public')->exists($user->ktp)) {
                Storage::disk('public')->delete($user->ktp);
            }
            $validated['ktp'] = $request->file('ktp')->store('documents', 'public');
        }

        if ($request->hasFile('npwp')) {
            // Delete old file if exists
            if ($user->npwp && Storage::disk('public')->exists($user->npwp)) {
                Storage::disk('public')->delete($user->npwp);
            }
            $validated['npwp'] = $request->file('npwp')->store('documents', 'public');
        }

        if ($request->hasFile('nib')) {
            // Delete old file if exists
            if ($user->nib && Storage::disk('public')->exists($user->nib)) {
                Storage::disk('public')->delete($user->nib);
            }
            $validated['nib'] = $request->file('nib')->store('documents', 'public');
        }

        // Fill user with validated data
        $user->fill($validated);

        // Handle email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save user
        $saved = $user->save();

        // Debug: Log after save
        Log::info('Save result:', ['saved' => $saved]);
        Log::info('User after update:', $user->fresh()->toArray());

        return Redirect::route('profile-edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function index()
    {
        return view('user.landings.index');
    }

    public function service()
    {
        return view('service.service');
    }

    public function booking()
    {
        return view('user.shipments.booking');
    }
}
