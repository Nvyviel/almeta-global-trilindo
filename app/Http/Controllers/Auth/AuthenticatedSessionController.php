<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Seal;
use App\Models\User;
use App\Models\Shipment;
use App\Models\StockSeal;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\PaymentController;

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
        if (auth()->user()->id === 1 && $user->id !== 1) {
            $user->is_admin = !$user->is_admin;
            $user->save();
        }

        return back()->with('status', 'Status has successfully changed');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->back()
                ->withErrors(['login' => 'Email or Password is wrong.'])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();

        session()->flash('success', 'Login successful. Welcome back, ' . Auth::user()->name . '!');

        // Check user status and role
        if (Auth::user()->is_admin) {
            return redirect()->route('dashboard-admin');
        }

        if (Auth::user()->status === 'Under Verification') {
            return redirect()->route('pending-view');
        }

        return redirect()->route('dashboard');
    }

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

        $paymentController = new PaymentController();
        $profits = $paymentController->calculateProfits();

        $users = $query->paginate(5);
        $totalUsers = User::where('is_admin', 0)->count();
        $totalAdmins = User::where('is_admin', 1)->count();
        $totalShipments = Shipment::count();
        $totalSeals = StockSeal::sum('stock');

        return view('admin.landings.dashboard-admin', compact(
            'users',
            'totalUsers',
            'totalAdmins',
            'totalShipments',
            'totalSeals',
            'profits'
        ));
    }

    public function detail($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        return view('admin.details.detail-user', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        $messages = [
            'Approved' => 'User has been approved successfully!',
            'Warned' => 'User has been set to warned!',
            'Under Verification' => 'You are under verification, please wait for a while.'
        ];

        $message = $messages[$request->status] ?? 'Status has been updated!';

        return redirect()->back()->with('success', $message);
    }

    // Controller Method
    public function updateDocument(Request $request): RedirectResponse
    {
        Log::info('Update document request received', $request->all());

        try {
            $request->validate([
                'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'document_type' => 'required|in:ktp,npwp,nib'
            ]);

            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            $document = $request->file('document');
            $documentType = $request->document_type;

            // Generate a more unique filename with user ID
            $filename = $documentType . '_' . $user->id . '_' . time() . '.' . $document->getClientOriginalExtension();
            $path = 'documents/' . $filename;

            // Store the new file first to ensure storage succeeds
            if (!$document->storeAs('documents', $filename, 'public')) {
                throw new \Exception('Failed to store document');
            }

            // Get the old path before updating
            $oldPath = $user->{$documentType};

            // Update user record
            $user->{$documentType} = $path;
            if (!$user->save()) {
                // If user update fails, delete the newly stored file
                Storage::delete('public/' . $path);
                throw new \Exception('Failed to update user record');
            }

            // Delete old file if it exists
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            return redirect()->back()->with('status', 'document-updated')
                ->with('message', ucfirst($documentType) . ' has been successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update document: ' . $e->getMessage()]);
        }
    }
}
