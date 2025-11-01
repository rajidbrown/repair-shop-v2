<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MechanicDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the logged-in mechanic ID from session
        $mechanicId = Session::get('mechanic_id');

        // Redirect to login if not authenticated
        if (!$mechanicId) {
            return redirect()->route('login.mechanic');
        }

        // Retrieve mechanic record from the database
        $mechanic = DB::table('Mechanics')
            ->where('MechanicID', $mechanicId)
            ->first();

        // Pass mechanic data to the dashboard view
        return view('mechanic.dashboard', compact('mechanic'));
    }
}