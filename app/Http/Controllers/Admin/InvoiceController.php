<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = DB::table('Invoices as i')
            ->join('Customers as c', 'i.CustomerID', '=', 'c.CustomerID')
            ->select('i.InvoiceID', 'i.DateIssued', 'i.TotalAmount', 'i.Description', 'c.FirstName', 'c.LastName')
            ->orderByDesc('i.DateIssued')
            ->get();

        return view('admin.invoices.index', compact('invoices'));
    }
}