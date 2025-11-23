<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerInfoController extends Controller
{
    public function showForm(Request $request)
    {
        $customerID = Session::get('customer_id');

        $customer = DB::table('Customers')
            ->where('CustomerID', $customerID)
            ->select('FirstName', 'LastName', 'Email', 'PhoneNumber', 'Address')
            ->first();

        return view('customer.update_info', [
            'customer' => $customer,
            'success' => session('success'),
            'error' => session('error')
        ]);
    }

    public function update(Request $request)
    {
        $customerID = Session::get('customer_id');

        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        try {
            DB::table('Customers')
                ->where('CustomerID', $customerID)
                ->update([
                    'FirstName' => $validated['firstName'],
                    'LastName' => $validated['lastName'],
                    'Email' => $validated['email'],
                    'PhoneNumber' => $validated['phoneNumber'],
                    'Address' => $validated['address'],
                    'UpdatedAt' => now()
                ]);

            return redirect()
                ->route('customer.update_info')
                ->with('success', 'Your information has been updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('customer.update_info')
                ->with('error', 'Error updating information: ' . $e->getMessage());
        }
    }
}