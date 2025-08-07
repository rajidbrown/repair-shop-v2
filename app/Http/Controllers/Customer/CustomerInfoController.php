<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerInfoController extends Controller
{
    public function showForm()
    {
        $customer = DB::table('Customers')->where('CustomerID', Auth::id())->first();
        return view('customer.update_info', compact('customer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:Customers,Email,' . Auth::id() . ',CustomerID',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        DB::table('Customers')->where('CustomerID', Auth::id())->update([
            'FirstName' => $request->firstName,
            'LastName' => $request->lastName,
            'Email' => $request->email,
            'PhoneNumber' => $request->phoneNumber,
            'Address' => $request->address,
            'UpdatedAt' => now(),
        ]);

        return redirect()->route('customer.update_info')->with('success', 'Your information has been updated successfully!');
    }
}