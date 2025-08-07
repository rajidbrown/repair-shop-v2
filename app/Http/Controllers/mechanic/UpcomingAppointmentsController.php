<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UpcomingAppointmentsController extends Controller
{
    public function index()
    {
        $mechanicID = Session::get('mechanic_id');

        if (!$mechanicID) {
            return redirect('/login_mechanic');
        }

        $appointments = DB::table('Appointments as A')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->join('Customers as C', 'B.CustomerID', '=', 'C.CustomerID')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->select(
                'B.Make', 'B.Model', 'B.Mileage',
                'C.FirstName', 'C.LastName',
                'A.AppointmentDateTime',
                'S.ServiceName'
            )
            ->where('A.MechanicID', $mechanicID)
            ->where('A.Status', '!=', 'Completed')
            ->orderBy('A.AppointmentDateTime', 'asc')
            ->get();

        return view('mechanic.upcoming_appointments', ['appointments' => $appointments]);
    }
}