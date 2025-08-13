<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MechanicCustomersController extends Controller
{
    public function index(Request $request)
    {
        // We’re continuing with session-based auth like the rest of your V2.
        $mechanicId = $request->session()->get('mechanic_id');
        if (!$mechanicId) {
            return redirect()->route('login.mechanic');
        }

        // Fetch distinct customers who have ever booked with this mechanic,
        // along with a bike (if any).
        $customers = DB::table('Appointments as a')
            ->join('Customers as c', 'a.CustomerID', '=', 'c.CustomerID')
            ->leftJoin('Bikes as b', 'b.CustomerID', '=', 'c.CustomerID')
            ->where('a.MechanicID', $mechanicId)
            ->select(
                'c.CustomerID',
                'c.FirstName',
                'c.LastName',
                'b.Year',
                'b.Make',
                'b.Model'
            )
            ->distinct()
            ->orderBy('c.LastName')
            ->orderBy('c.FirstName')
            ->get();

        return view('mechanic.customers', compact('customers'));
    }
}