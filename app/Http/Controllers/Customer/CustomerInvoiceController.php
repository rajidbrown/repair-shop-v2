<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerInvoiceController extends Controller
{
    public function index()
    {
        $customerID = Auth::id(); // Auth must be configured for customers

        $invoices = DB::table('Invoices')
            ->where('CustomerID', $customerID)
            ->orderByDesc('DateIssued')
            ->select('InvoiceID', 'DateIssued', 'TotalAmount', 'Description')
            ->get();

        return view('customer.invoices', compact('invoices'));
    }
}