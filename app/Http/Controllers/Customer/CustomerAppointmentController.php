<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAppointmentController extends Controller
{
    /**
     * Show the customer's appointments (all NOT completed).
     */
    public function index(Request $request)
    {
        $customerId = $request->session()->get('customer_id');
        if (!$customerId) {
            return redirect()->route('login.customer');
        }

        // Match mechanic logic: show anything NOT completed (including NULL)
        $appointments = DB::table('Appointments as a')
            ->join('Services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->join('Mechanics as m', 'a.MechanicID', '=', 'm.MechanicID')
            ->where('a.CustomerID', $customerId)
            ->where(function ($q) {
                $q->whereNull('a.Status')
                  ->orWhere('a.Status', '!=', 'Completed');
            })
            ->orderBy('a.AppointmentDateTime', 'asc')
            ->get([
                'a.AppointmentID',
                'a.AppointmentDateTime',
                's.ServiceName',
                DB::raw("m.FirstName as MechanicFirstName"),
                DB::raw("m.LastName as MechanicLastName"),
            ]);

        return view('customer.appointments', [
            'appointments'  => $appointments,
            'deleteSuccess' => session('deleteSuccess'),
            'deleteError'   => session('deleteError'),
        ]);
    }

    /**
     * Delete an appointment (only if NOT completed).
     */
    public function destroy(Request $request, int $appointmentId)
    {
        $customerId = $request->session()->get('customer_id');
        if (!$customerId) {
            return redirect()->route('login.customer');
        }

        try {
            $deleted = DB::table('Appointments')
                ->where('AppointmentID', $appointmentId)
                ->where('CustomerID', $customerId)
                ->where(function ($q) {
                    $q->whereNull('Status')
                      ->orWhere('Status', '!=', 'Completed');
                })
                ->delete();

            return $deleted
                ? back()->with('deleteSuccess', 'Appointment deleted successfully.')
                : back()->with('deleteError', 'Unable to delete this appointment.');
        } catch (\Throwable $e) {
            return back()->with('deleteError', 'Unable to delete this appointment.');
        }
    }
}
