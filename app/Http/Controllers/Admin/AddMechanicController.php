<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddMechanicController extends Controller
{
    /**
     * Show "Add Mechanic" form
     */
    public function showForm()
    {
        return view('admin.add_mechanic', ['message' => '']);
    }

    /**
     * Handle "Add Mechanic" submit
     * (Route: POST /admin/add-mechanic -> name: admin.add_mechanic.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName'   => 'required|string',
            'lastName'    => 'required|string',
            'email'       => 'required|email|unique:Mechanics,Email',
            'password'    => 'required|min:6',
            'specialty'   => 'nullable|string',
            'phoneNumber' => 'nullable|string',
        ]);

        try {
            DB::table('Mechanics')->insert([
                'FirstName'   => $request->input('firstName'),
                'LastName'    => $request->input('lastName'),
                'Email'       => $request->input('email'),
                'Password'    => Hash::make($request->input('password')),
                'Specialty'   => $request->input('specialty'),
                'PhoneNumber' => $request->input('phoneNumber'),
                'CreatedAt'   => now(),
                'UpdatedAt'   => now(),
            ]);

            // keep existing pattern of passing an HTML message
            return view('admin.add_mechanic', [
                'message' => '<p class="success">Mechanic added successfully!</p>',
            ]);
        } catch (\Exception $e) {
            return view('admin.add_mechanic', [
                'message' => '<p class="error">Error adding mechanic: ' . e($e->getMessage()) . '</p>',
            ]);
        }
    }

    /**
     * Show "Edit Mechanic" form
     * (Route: GET /admin/mechanics/{id}/edit -> name: admin.mechanics.edit)
     */
    public function edit($id)
    {
        $mechanic = DB::table('Mechanics')
            ->where('MechanicID', $id)
            ->first();

        if (!$mechanic) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Mechanic not found.');
        }

        // Expec a view at resources/views/admin/mechanics/edit.blade.php
        return view('admin.mechanics.edit', compact('mechanic'));
    }

    /**
     * Handle "Edit Mechanic" submit
     * (Route: POST /admin/mechanics/{id} -> name: admin.mechanics.update)
     */
    public function update(Request $request, $id)
    {
        // unique on Email but ignore current row by PK "MechanicID"
        $request->validate([
            'firstName'   => 'required|string',
            'lastName'    => 'required|string',
            'email'       => 'required|email|unique:Mechanics,Email,' . $id . ',MechanicID',
            'password'    => 'nullable|min:6',
            'specialty'   => 'nullable|string',
            'phoneNumber' => 'nullable|string',
        ]);

        try {
            $data = [
                'FirstName'   => $request->input('firstName'),
                'LastName'    => $request->input('lastName'),
                'Email'       => $request->input('email'),
                'Specialty'   => $request->input('specialty'),
                'PhoneNumber' => $request->input('phoneNumber'),
                'UpdatedAt'   => now(),
            ];

            if ($request->filled('password')) {
                $data['Password'] = Hash::make($request->input('password'));
            }

            $updated = DB::table('Mechanics')
                ->where('MechanicID', $id)
                ->update($data);

            return redirect()
                ->route('admin.dashboard')
                ->with($updated ? 'success' : 'error', $updated ? 'Mechanic updated successfully!' : 'No changes saved.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating mechanic: ' . e($e->getMessage()));
        }
    }
}