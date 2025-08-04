<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MechanicDashboardController extends Controller
{
    public function index()
    {
        // Optional: restrict access to authenticated mechanics only
        if (!Auth::check()) {
            return redirect()->route('login.mechanic');
        }

        return view('mechanic.dashboard');
    }
}