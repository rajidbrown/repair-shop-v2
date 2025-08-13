<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewCustomersController extends Controller
{
    public function index()
    {
        // Fetch all customers with their bikes
        $customers = DB::table('Customers as c')
            ->leftJoin('Bikes as b', 'c.CustomerID', '=', 'b.CustomerID')
            ->select(
                'c.CustomerID',
                'c.FirstName',
                'c.LastName',
                'c.Email',
                'c.PhoneNumber',
                'c.CreatedAt',
                'b.Make',
                'b.Model',
                'b.Mileage'
            )
            ->orderBy('c.LastName')
            ->orderBy('c.FirstName')
            ->get()
            ->groupBy('CustomerID');

        return view('admin.view_customers', compact('customers'));
    }
}