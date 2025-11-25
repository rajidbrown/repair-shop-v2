<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BikeController extends Controller
{
    // -----------------------------
    // LIST ALL BIKES FOR CUSTOMER
    // -----------------------------
    public function index()
    {
        $customerID = session('customer_id');

        if (!$customerID) {
            abort(403, 'Unauthorized');
        }

        $bikes = DB::table('Bikes')
            ->where('CustomerID', $customerID)
            ->orderBy('BikeID')
            ->get();

        return view('customer.bikes.index', compact('bikes'));
    }

    // -----------------------------
    // SHOW CREATE FORM
    // -----------------------------
    public function create()
    {
        return view('customer.bikes.create');
    }

    // -----------------------------
    // STORE NEW BIKE
    // -----------------------------
    public function store(Request $request)
    {
        $customerID = session('customer_id');

        if (!$customerID) {
            abort(403);
        }

        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2099',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
        ]);

        DB::table('Bikes')->insert([
            'CustomerID' => $customerID,
            'Year' => $validated['year'],
            'Make' => $validated['make'],
            'Model' => $validated['model'],
            'Mileage' => $validated['mileage'],
            'CreatedAt' => now(),
            'UpdatedAt' => now(),
        ]);

        return redirect()->route('customer.bikes.index')
            ->with('success', 'Bike added successfully!');
    }

    // -----------------------------
    // SHOW EDIT FORM
    // -----------------------------
    public function edit($bikeID)
    {
        $customerID = session('customer_id');

        $bike = DB::table('Bikes')
            ->where('BikeID', $bikeID)
            ->where('CustomerID', $customerID)
            ->first();

        if (!$bike) {
            abort(404);
        }

        return view('customer.bikes.edit', compact('bike'));
    }

    // -----------------------------
    // UPDATE BIKE
    // -----------------------------
    public function update(Request $request, $bikeID)
    {
        $customerID = session('customer_id');

        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2099',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
        ]);

        DB::table('Bikes')
            ->where('BikeID', $bikeID)
            ->where('CustomerID', $customerID)
            ->update([
                'Year' => $validated['year'],
                'Make' => $validated['make'],
                'Model' => $validated['model'],
                'Mileage' => $validated['mileage'],
                'UpdatedAt' => now(),
            ]);

        return redirect()->route('customer.bikes.index')
            ->with('success', 'Bike updated successfully!');
    }
}