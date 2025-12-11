<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Mechanics use session-based login, not Laravel Auth
        $mechanicId = session('mechanic_id');

        $history = DB::table('Appointments as A')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->join('Customers as C', 'A.CustomerID', '=', 'C.CustomerID')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->select(
                'A.AppointmentDateTime',
                'S.ServiceName',
                'C.FirstName',
                'C.LastName',
                'A.Notes',
                'B.Make',
                'B.Model',
                'B.Mileage',
                'A.Status'
            )
            ->where('A.MechanicID', $mechanicId)
            ->where('A.Status', 'Completed')
            ->orderByDesc('A.AppointmentDateTime')
            ->get();

        return view('mechanic.service_history', [
            'history' => $history,
            'statusUpdated' => $request->query('status_updated') == 1,
        ]);
    }
}