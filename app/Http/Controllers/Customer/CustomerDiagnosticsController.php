<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerDiagnosticsController extends Controller
{
    public function index()
    {
        $customerID = Auth::id();
        if (!$customerID) {
            return redirect()->route('login.customer');
        }

        // Pull all appointments and join diagnostics
        $appointments = DB::table('Appointments as A')
            ->leftJoin('Diagnostics as D', function ($join) {
                $join->on('A.AppointmentID', '=', 'D.AppointmentID');
            })
            ->leftJoin('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->leftJoin('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->select(
                'A.AppointmentID',
                'A.AppointmentDateTime',
                'D.IssueFound',
                'D.Recommendation',
                'D.CreatedAt as DiagnosticCreatedAt',
                'B.Year',
                'B.Make',
                'B.Model',
                'S.ServiceName'
            )
            ->where('A.CustomerID', $customerID)
            ->orderByDesc('A.AppointmentDateTime')
            ->get();

        return view('customer.diagnostics', [
            'appointments' => $appointments
        ]);
    }
}