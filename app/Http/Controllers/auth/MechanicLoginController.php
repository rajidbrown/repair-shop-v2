<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class MechanicLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_mechanic');
    }

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
            Session::put('mechanic_id', $mechanic->MechanicID);
            return redirect()->route('mechanic.dashboard'); // Set this route up later
        }

        return back()->withErrors(['login_error' => 'Invalid email or password.'])->withInput();
    }
}