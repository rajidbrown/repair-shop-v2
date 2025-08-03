<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UpcomingAppointmentsController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $nextWeek = Carbon::today()->addDays(7)->toDateString();

        $appointments = DB::table('Appointments as A')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->join('Customers as C', 'B.CustomerID', '=', 'C.CustomerID')
            ->join('Mechanics as M', 'A.MechanicID', '=', 'M.MechanicID')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->whereBetween(DB::raw('DATE(A.AppointmentDateTime)'), [$today, $nextWeek])
            ->orderBy('A.AppointmentDateTime', 'asc')
            ->select(
                'B.Make', 'B.Model', 'B.Mileage',
                'C.FirstName as CustomerFirst', 'C.LastName as CustomerLast',
                'M.FirstName as MechFirst', 'M.LastName as MechLast',
                'A.AppointmentDateTime',
                'S.ServiceName'
            )
            ->get();

        return view('admin.appointments.upcoming', compact('appointments'));
    }
}