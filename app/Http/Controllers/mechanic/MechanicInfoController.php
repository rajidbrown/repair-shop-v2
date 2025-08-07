<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MechanicInfoController extends Controller
{
    public function showForm(Request $request)
    {
        $mechanicID = Session::get('mechanic_id');

        $mechanic = DB::table('Mechanics')
            ->where('MechanicID', $mechanicID)
            ->select('FirstName', 'LastName', 'Email', 'Specialty', 'PhoneNumber')
            ->first();

        return view('mechanic.update_info', [
            'mechanic' => $mechanic,
            'success' => session('success'),
            'error' => session('error')
        ]);
    }

    public function update(Request $request)
    {
        $mechanicID = Session::get('mechanic_id');

        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'specialty' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:20',
        ]);

        try {
            DB::table('Mechanics')
                ->where('MechanicID', $mechanicID)
                ->update([
                    'FirstName' => $validated['firstName'],
                    'LastName' => $validated['lastName'],
                    'Email' => $validated['email'],
                    'Specialty' => $validated['specialty'],
                    'PhoneNumber' => $validated['phoneNumber'],
                    'UpdatedAt' => now()
                ]);

            return redirect()
                ->route('mechanic.info')
                ->with('success', 'Your information has been updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('mechanic.info')
                ->with('error', 'Error updating information: ' . $e->getMessage());
        }
    }
}