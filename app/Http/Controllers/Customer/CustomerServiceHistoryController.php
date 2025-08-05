<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CustomerServiceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $customerId = Session::get('customer_id');

        if (!$customerId) {
            return redirect()->route('login.customer');
        }

        $history = DB::table('Appointments as A')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->where('A.CustomerID', $customerId)
            ->where('A.Status', 'Completed')
            ->orderBy('A.AppointmentDateTime', 'desc')
            ->select('A.AppointmentDateTime', 'S.ServiceName', 'A.Notes', 'A.Status')
            ->get();

        return view('customer.service_history', compact('history'));
    }
}