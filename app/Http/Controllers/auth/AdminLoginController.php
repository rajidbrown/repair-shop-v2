<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    /**
     * Handle the admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = DB::table('Admins')->where('Username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->Password)) {
            // ✅ Store unified session keys
            Session::put([
                'admin_id' => $admin->AdminID,
                'admin_username' => $admin->Username,
                'name' => $admin->Username ?? 'Admin', // shared key for dashboards
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid username or password'])->withInput();
    }

    /**
     * Log the admin out.
     */
    public function logout()
    {
        // ✅ Forget all admin-related session data
        Session::forget(['admin_id', 'admin_username', 'name']);
        return redirect()->route('login.admin');
    }
}