<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\Bill;
use App\Models\Seal;
use App\Models\User;
use Midtrans\Config;
use App\Models\Shipment;
use App\Models\StockSeal;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email not registered.'])
                ->withInput();
        }

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->back()
                ->withErrors(['password' => 'Password wrong.'])
                ->withInput();
        }

        $request->session()->regenerate();

        session()->flash('success', 'Login successful. Welcome back, ' . Auth::user()->name . '!');

        if (Auth::user()->is_admin) {
            return redirect()->route('dashboard-admin');
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

        $users = $query->paginate(5);

        $totalUsers = User::where('is_admin', 0)->count();
        $totalAdmins = User::where('is_admin', 1)->count();
        $totalShipments = Shipment::count();
        $totalSeals = StockSeal::sum('stock');

        return view('admin.dashboard-admin', compact('users', 'totalUsers', 'totalAdmins', 'totalShipments', 'totalSeals'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.detail-user', compact('user'));
    }

    public function handleCallback(Request $request)
    {
        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

            // Debugging Log
            Log::info('Received Midtrans Callback', ['request' => $request->all()]);

            $notificationBody = json_decode($request->getContent(), true);

            if (!isset($notificationBody['order_id']) || !isset($notificationBody['transaction_status'])) {
                Log::error('Invalid Midtrans Callback Data', ['data' => $notificationBody]);
                return response()->json(['error' => 'Invalid data'], 400);
            }

            $orderId = $notificationBody['order_id'];
            $transactionStatus = $notificationBody['transaction_status'];
            $fraudStatus = $notificationBody['fraud_status'] ?? null;
            $paymentType = $notificationBody['payment_type'] ?? null;

            $type = explode(" - ", $orderId);


        
            if($type[0] == "BL"){
                // Cek apakah order ditemukan
                $bill = Bill::where('bill_id', $orderId)->first();
                if (!$bill) {
                    Log::error('Seal not found for order: ' . $orderId);
                    return response()->json(['error' => 'Order not found'], 404);
                }

                Log::info('Processing transaction', ['bill_id' => $orderId, 'status' => $transactionStatus]);

                switch ($transactionStatus) {
                    case 'capture':
                        if ($paymentType == 'credit_card') {
                            $bill->status = ($fraudStatus == 'challenge') ? 'payment_process' : 'success';
                        }
                        break;
                    case 'settlement':
                        $bill->status = 'Paid';
                        break;
                    case 'pending':
                        $bill->status = 'Unpaid';
                        break;
                    case 'deny':
                    case 'expire':
                    case 'cancel':
                        $bill->status = 'Canceled';
                        break;
                }

                $bill->save();

                Log::info('Transaction updated successfully', ['bill_id' => $orderId, 'new_status' => $bill->status]);

                return response()->json(['status' => 'success']);
            }


            // Cek apakah order ditemukan
            $seal = Seal::where('id_seal', $orderId)->first();
            if (!$seal) {
                Log::error('Seal not found for order: ' . $orderId);
                return response()->json(['error' => 'Order not found'], 404);
            }

            Log::info('Processing transaction', ['order_id' => $orderId, 'status' => $transactionStatus]);

            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        $seal->status = ($fraudStatus == 'challenge') ? 'payment_process' : 'success';
                    }
                    break;
                case 'settlement':
                    $seal->status = 'Success';
                    break;
                case 'pending':
                    $seal->status = 'Payment Proccess';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $seal->status = 'Canceled';
                    break;
            }

            $seal->save();

            Log::info('Transaction updated successfully', ['order_id' => $orderId, 'new_status' => $seal->status]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
