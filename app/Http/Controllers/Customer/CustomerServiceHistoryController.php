<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerServiceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $customerId = session('customer_id'); // customer login session

        $history = DB::table('Appointments as A')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->select(
                'A.AppointmentDateTime',
                'A.Status',
                'A.Notes',
                'S.ServiceName',
                'B.Make',
                'B.Model',
                'B.Mileage'
            )
            ->where('A.CustomerID', $customerId)
            ->where('A.Status', 'Completed')
            ->orderByDesc('A.AppointmentDateTime')
            ->get();

        return view('customer.service_history', [
            'history' => $history,
        ]);
    }
}
