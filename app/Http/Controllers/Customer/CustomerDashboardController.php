<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerID = Session::get('customer_id');

        if (!$customerID) {
            return redirect()->route('login.customer')->withErrors(['login' => 'Please log in first.']);
        }

        $customer = DB::table('customers')  // Use lowercase table name to match actual schema
            ->select('FirstName', 'LastName')
            ->where('CustomerID', $customerID)
            ->first();

        if (!$customer) {
            return redirect()->route('login.customer')->withErrors(['login' => 'Customer not found.']);
        }

        return view('customer.dashboard', compact('customer'));
    }
}