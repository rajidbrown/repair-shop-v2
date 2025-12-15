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

        $today = now()->toDateString();

        $appointments = DB::table('Appointments as a')
            ->join('Customers as c', 'a.CustomerID', '=', 'c.CustomerID')
            ->join('Services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->leftJoin('Bikes as b', 'b.BikeID', '=', 'a.BikeID')
            ->where('a.MechanicID', $mechanicId)
            ->where(function ($query) use ($today) {
                $query
                    ->whereDate('a.AppointmentDateTime', $today)
                    ->where(function ($q) {
                        $q->whereNull('a.Status')
                          ->orWhere('a.Status', 'Not Started')
                          ->orWhere('a.Status', 'Started');
                    })
                    ->orWhere(function ($q) {
                        $q->where('a.Status', 'Started');
                    });
            })
            ->orderBy('a.AppointmentDateTime', 'asc')
            ->select(
                'a.AppointmentID',
                'a.AppointmentDateTime',
                'a.Status',
                'a.Notes',
                'c.FirstName',
                'c.LastName',
                's.ServiceName',
                'b.Year',
                'b.Make',
                'b.Model'
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
            'status'         => 'required|string',
            'notes'          => 'nullable|string',
        ]);

        DB::table('Appointments')
            ->where('AppointmentID', $request->appointment_id)
            ->where('MechanicID', $mechanicId)
            ->update([
                'Status'    => $request->status,
                'Notes'     => $request->notes,
                'UpdatedAt' => now(),
            ]);

        return redirect()
            ->route('mechanic.todo')
            ->with('success', 'Appointment updated.');
    }
}
