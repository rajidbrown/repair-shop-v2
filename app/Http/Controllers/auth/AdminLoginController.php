<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = DB::table('Admins')->where('Username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->Password)) {
            Session::put('admin_id', $admin->AdminID);
            Session::put('admin_username', $admin->Username);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid username or password'])->withInput();
    }

    public function logout()
    {
        Session::forget(['admin_id', 'admin_username']);
        return redirect()->route('login.admin');
    }
}
