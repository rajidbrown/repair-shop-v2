<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class MechanicLoginController extends Controller
{
    /**
     * Show the mechanic login form.
     */
    public function showLoginForm()
    {
        return view('auth.login_mechanic');
    }

    /**
     * Handle mechanic login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $mechanic = DB::table('Mechanics')->where('Email', $email)->first();

        if ($mechanic && password_verify($password, $mechanic->Password)) {
            Session::put([
                'mechanic_id' => $mechanic->MechanicID,
                'mechanic_name' => $mechanic->FirstName . ' ' . $mechanic->LastName,
                'name' => $mechanic->FirstName, // ✅ shared key for dashboard welcome
            ]);

            return redirect()->route('mechanic.dashboard');
        }

        return back()->withErrors(['login_error' => 'Invalid email or password.'])->withInput();
    }

    /**
     * Log the mechanic out.
     */
    public function logout()
    {
        Session::forget(['mechanic_id', 'mechanic_name', 'name']);
        return redirect()->route('login.mechanic');
    }
}