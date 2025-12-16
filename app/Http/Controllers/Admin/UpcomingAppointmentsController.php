<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UpcomingAppointmentsController extends Controller
{
    public function index()
    {
        $appointments = DB::table('Appointments as A')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->join('Customers as C', 'B.CustomerID', '=', 'C.CustomerID')
            ->join('Mechanics as M', 'A.MechanicID', '=', 'M.MechanicID')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->where(function ($q) {
                $q->whereNull('A.Status')
                  ->orWhere('A.Status', '!=', 'Completed');
            })
            ->orderBy('A.AppointmentDateTime', 'asc')
            ->select(
                'B.Make', 'B.Model', 'B.Mileage',
                'C.FirstName as CustomerFirst', 'C.LastName as CustomerLast',
                'M.FirstName as MechFirst', 'M.LastName as MechLast',
                'A.AppointmentDateTime',
                'S.ServiceName',
                'A.Status'
            )
            ->get();

        return view('admin.appointments.upcoming', compact('appointments'));
    }
}
