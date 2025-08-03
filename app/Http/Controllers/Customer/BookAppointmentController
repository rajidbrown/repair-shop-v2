<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookAppointmentController extends Controller
{
    public function showForm()
    {
        $customerID = Session::get('customer_id');

        $bikes = DB::table('Bikes')
            ->where('CustomerID', $customerID)
            ->select('BikeID', 'Year', 'Make', 'Model')
            ->get();

        $services = DB::table('Services')->select('ServiceID', 'ServiceName')->get();

        return view('customer.appointments.book', compact('bikes', 'services'));
    }

    public function store(Request $request)
    {
        $bookingMessage = "";

        $request->validate([
            'bike_id' => 'required|integer',
            'serviceID' => 'required|integer',
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required',
        ]);

        $customerID = Session::get('customer_id');
        $bikeID = $request->bike_id;
        $repairID = $request->serviceID;
        $appointmentDate = $request->appointmentDate;
        $appointmentTime = $request->appointmentTime;
        $selectedSlot = "$appointmentDate $appointmentTime";

        $existing = DB::table('Appointments')
            ->where('AppointmentDateTime', $selectedSlot)
            ->exists();

        if ($existing) {
            $bookingMessage = "That time slot is already booked. Please choose another.";
        } else {
            $service = DB::table('Services')->where('ServiceID', $repairID)->first();
            if (!$service) {
                $bookingMessage = "Invalid service selected.";
            } else {
                $duration = $service->DurationMinutes;
                $serviceName = $service->ServiceName;

                $dayOfWeek = Carbon::parse($selectedSlot)->format('l');
                $time = Carbon::parse($selectedSlot)->format('H:i:s');
                $endTime = Carbon::parse($selectedSlot)->addMinutes($duration)->format('H:i:s');

                $mechanic = DB::table('Mechanics as m')
                    ->join('Schedule as s', 'm.MechanicID', '=', 's.MechanicID')
                    ->where('m.Specialty', $serviceName)
                    ->where('s.DayOfWeek', $dayOfWeek)
                    ->where('s.StartTime', '<=', $time)
                    ->where('s.EndTime', '>=', $endTime)
                    ->whereNotExists(function ($query) use ($selectedSlot, $duration) {
                        $query->select(DB::raw(1))
                              ->from('Appointments as a')
                              ->whereRaw('a.MechanicID = m.MechanicID')
                              ->where('a.AppointmentDateTime', '<', $selectedSlot)
                              ->whereRaw("DATE_ADD(a.AppointmentDateTime, INTERVAL {$duration} MINUTE) > ?", [$selectedSlot]);
                    })
                    ->select('m.MechanicID')
                    ->first();

                if ($mechanic) {
                    DB::table('Appointments')->insert([
                        'CustomerID' => $customerID,
                        'MechanicID' => $mechanic->MechanicID,
                        'ServiceID' => $repairID,
                        'BikeID' => $bikeID,
                        'AppointmentDateTime' => $selectedSlot,
                    ]);

                    $bookingMessage = "✅ Appointment booked for " . Carbon::parse($selectedSlot)->format('g:i A, F j, Y');
                } else {
                    $bookingMessage = "❌ No mechanics available with matching specialty at that time.";
                }
            }
        }

        return redirect()->back()->with('bookingMessage', $bookingMessage);
    }
}