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
            'password' => 'required'
        ]);

        $customer = DB::table('Customers')
            ->where('Email', $request->input('email'))
            ->first();

        if ($customer && Hash::check($request->input('password'), $customer->Password)) {
            Session::put('customer_logged_in', true);
            Session::put('customer_id', $customer->CustomerID);
            return redirect()->route('customer.dashboard');
        } else {
            return redirect()->route('login.customer')
                ->withErrors(['login' => 'Invalid credentials.'])
                ->withInput();
        }
    }
}
