<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAppointmentController extends Controller
{
    /**
     * Show the customer's appointments.
     */
    public function index(Request $request)
    {
        $customerId = $request->session()->get('customer_id');
        if (!$customerId) {
            return redirect()->route('login.customer');
        }

        $appointments = DB::table('Appointments as a')
            ->join('Services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->join('Mechanics as m', 'a.MechanicID', '=', 'm.MechanicID')
            ->where('a.CustomerID', $customerId)
            ->orderBy('a.AppointmentDateTime', 'desc')
            ->get([
                'a.AppointmentID',
                'a.AppointmentDateTime',
                's.ServiceName',
                DB::raw("m.FirstName as MechanicFirstName"),
                DB::raw("m.LastName as MechanicLastName"),
            ]);

        return view('customer.appointments', [
            'appointments'   => $appointments,
            'deleteSuccess'  => session('deleteSuccess'),
            'deleteError'    => session('deleteError'),
        ]);
    }

    /**
     * Delete a specific appointment (only if it belongs to the logged-in customer).
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
                ->delete();

            if ($deleted) {
                return back()->with('deleteSuccess', 'Appointment deleted successfully.');
            }
            return back()->with('deleteError', 'Failed to delete appointment.');
        } catch (\Throwable $e) {
            return back()->with('deleteError', 'Failed to delete appointment.');
        }
    }
}