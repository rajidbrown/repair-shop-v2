<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MechanicTodoController extends Controller
{
    public function index(Request $request)
    {
        $mechanicId = Session::get('mechanic_id');
        if (!$mechanicId) {
            return redirect()->route('login.mechanic');
        }

        $appointments = DB::table('Appointments as a')
            ->join('Customers as c', 'a.CustomerID', '=', 'c.CustomerID')
            ->join('Services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->leftJoin('Bikes as b', 'b.CustomerID', '=', 'c.CustomerID')
            ->where('a.MechanicID', $mechanicId)
            ->whereDate('a.AppointmentDateTime', now()->toDateString())
            ->where(function($query) {
                $query->whereNull('a.Status')
                      ->orWhere('a.Status', '!=', 'Completed');
            })
            ->orderBy('a.AppointmentDateTime', 'asc')
            ->select(
                'a.AppointmentID', 'a.AppointmentDateTime', 'a.Status',
                'c.FirstName', 'c.LastName',
                's.ServiceName',
                'b.Year', 'b.Make', 'b.Model'
            )
            ->get();

        return view('mechanic.todo', compact('appointments'));
    }

    public function update(Request $request)
    {
        $mechanicId = Session::get('mechanic_id');
        if (!$mechanicId) {
            return redirect()->route('login.mechanic');
        }

        $request->validate([
            'appointment_id' => 'required|integer',
            'status' => 'required|string'
        ]);

        DB::table('Appointments')
            ->where('AppointmentID', $request->appointment_id)
            ->where('MechanicID', $mechanicId)
            ->update([
                'Status' => $request->status
            ]);

        return redirect()->route('mechanic.todo')->with('success', 'Status updated.');
    }
}