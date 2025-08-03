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

        $diagnostics = DB::table('Diagnostics as D')
            ->join('Appointments as A', 'D.AppointmentID', '=', 'A.AppointmentID')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->select(
                'D.IssueFound',
                'D.Recommendation',
                'D.CreatedAt',
                'A.AppointmentDateTime',
                'S.ServiceName',
                'B.Year',
                'B.Make',
                'B.Model'
            )
            ->where('A.CustomerID', $customerID)
            ->orderByDesc('D.CreatedAt')
            ->get();

        return view('customer.diagnostics', compact('diagnostics'));
    }
}