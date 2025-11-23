<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerDiagnosticsController extends Controller
{
    public function index(Request $request)
    {
        // Check if customer is logged in via session
        $customerID = $request->session()->get('customer_id');

        if (!$customerID) {
            // Redirect to login if not logged in
            return redirect()->route('login.customer');
        }

        // Fetch diagnostics for this customer
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