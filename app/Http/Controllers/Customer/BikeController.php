<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BikeController extends Controller
{
    public function showForm()
    {
        $customerID = session('customer_id');

        if (!$customerID) {
            abort(403, 'Unauthorized. Customer not logged in.');
        }

        $bike = DB::table('Bikes')
            ->where('CustomerID', $customerID)
            ->first();

        return view('customer.my_bike', ['bike' => $bike]);
    }

    public function update(Request $request)
    {
        $customerID = session('customer_id');

        if (!$customerID) {
            return redirect()->back()->withErrors(['error' => 'You must be logged in as a customer.']);
        }

        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2099',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
        ]);

        $existingBike = DB::table('Bikes')->where('CustomerID', $customerID)->first();

        if ($existingBike) {
            DB::table('Bikes')
                ->where('CustomerID', $customerID)
                ->update([
                    'Year' => $validated['year'],
                    'Make' => $validated['make'],
                    'Model' => $validated['model'],
                    'Mileage' => $validated['mileage'],
                    'UpdatedAt' => now(),
                ]);
        } else {
            DB::table('Bikes')->insert([
                'CustomerID' => $customerID,
                'Year' => $validated['year'],
                'Make' => $validated['make'],
                'Model' => $validated['model'],
                'Mileage' => $validated['mileage'],
                'CreatedAt' => now(),
                'UpdatedAt' => now(),
            ]);
        }

        return redirect()->route('customer.bike')->with('success', 'Your bike information has been updated successfully!');
    }
}