<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AddMechanicController extends Controller
{
    public function showForm()
    {
        return view('admin.add_mechanic', ['message' => '']);
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:Mechanics,Email',
            'password' => 'required',
        ]);

        try {
            DB::table('Mechanics')->insert([
                'FirstName' => $request->input('firstName'),
                'LastName' => $request->input('lastName'),
                'Email' => $request->input('email'),
                'Password' => Hash::make($request->input('password')),
                'Specialty' => $request->input('specialty'),
                'PhoneNumber' => $request->input('phoneNumber'),
                'CreatedAt' => now(),
                'UpdatedAt' => now(),
            ]);

            return view('admin.add_mechanic', ['message' => '<p class="success">Mechanic added successfully!</p>']);
        } catch (\Exception $e) {
            return view('admin.add_mechanic', ['message' => '<p class="error">Error adding mechanic: ' . $e->getMessage() . '</p>']);
        }
    }
}