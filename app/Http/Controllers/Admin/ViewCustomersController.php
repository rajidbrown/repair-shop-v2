<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewCustomersController extends Controller
{
    public function index()
    {
        $customers = DB::table('Customers')
            ->select('CustomerID', 'FirstName', 'LastName', 'Email', 'PhoneNumber', 'CreatedAt')
            ->orderBy('LastName')
            ->orderBy('FirstName')
            ->get();

        return view('admin.customers.index', compact('customers'));
    }
}