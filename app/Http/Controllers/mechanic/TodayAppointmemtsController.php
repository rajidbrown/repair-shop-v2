<?php

namespace App\Http\Controllers\Mechanic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TodayAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $mechanicId = $request->session()->get('mechanic_id');
        if (!$mechanicId) {
            return redirect()->route('login.mechanic');
        }

        $today = now()->toDateString();

        $appointments = DB::table('Appointments as a')
            ->join('Customers as c', 'a.CustomerID', '=', 'c.CustomerID')
            ->join('Services as s', 'a.ServiceID', '=', 's.ServiceID')
            // If your Appointments has BikeID, this is more precise than joining by CustomerID:
            ->leftJoin('Bikes as b', 'b.BikeID', '=', 'a.BikeID')
            ->where('a.MechanicID', $mechanicId)
            ->whereDate('a.AppointmentDateTime', $today)
            ->orderBy('a.AppointmentDateTime')
            ->get([
                'a.AppointmentDateTime',
                'c.FirstName as CustomerFirstName',
                'c.LastName as CustomerLastName',
                's.ServiceName',
                'b.Year',
                'b.Make',
                'b.Model',
            ]);

        return view('mechanic.today_appointments', compact('appointments'));
    }
}