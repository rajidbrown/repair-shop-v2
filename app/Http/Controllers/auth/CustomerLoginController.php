<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerLoginController extends Controller
{
    /**
     * Show the customer login form.
     */
    public function showLoginForm()
    {
        return view('auth.login_customer');
    }

    /**
     * Handle the customer login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $customer = DB::table('Customers')->where('Email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->Password)) {
            // ✅ Store shared session values
            Session::put([
                'customer_id' => $customer->CustomerID,
                'customer_name' => $customer->FirstName . ' ' . $customer->LastName,
                'name' => $customer->FirstName, // shared key for dashboard welcome
            ]);

            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid email or password.'])->withInput();
    }

    /**
     * Log the customer out.
     */
    public function logout()
    {
        // ✅ Clear all session values
        Session::forget(['customer_id', 'customer_name', 'name']);
        return redirect()->route('login.customer');
    }
}