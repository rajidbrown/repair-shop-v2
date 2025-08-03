<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerID = Auth::id(); // Assumes you're using Laravel's built-in auth system

        $customer = DB::table('Customers')
            ->select('FirstName', 'LastName')
            ->where('CustomerID', $customerID)
            ->first();

        return view('customer.dashboard', compact('customer'));
    }
}