<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_customer');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $customer = DB::table('customers')->where('Email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->Password)) {
            Session::put('customer_id', $customer->CustomerID);
            Session::put('customer_name', $customer->FirstName . ' ' . $customer->LastName);
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid email or password.'])->withInput();
    }

    public function logout()
    {
        Session::forget(['customer_id', 'customer_name']);
        return redirect()->route('login.customer');
    }
}