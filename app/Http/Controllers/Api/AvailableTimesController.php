<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvailableTimesController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $serviceID = $request->query('serviceID');

        if (empty($date) || empty($serviceID)) {
            return response()->json([]);
        }

        $dayOfWeek = date('l', strtotime($date));

        // Get service duration and name
        $service = DB::table('Services')
            ->select('DurationMinutes', 'ServiceName')
            ->where('ServiceID', $serviceID)
            ->first();

        if (!$service) {
            return response()->json([]);
        }

        // Get matching schedules for that day and specialty
        $schedules = DB::table('Schedule as s')
            ->join('Mechanics as m', 's.MechanicID', '=', 'm.MechanicID')
            ->where('s.DayOfWeek', $dayOfWeek)
            ->where('m.Specialty', $service->ServiceName)
            ->select('s.MechanicID', 's.StartTime', 's.EndTime')
            ->get();

        if ($schedules->isEmpty()) {
            return response()->json([]);
        }

        // Build time slots
        $timeSlots = [];
        foreach ($schedules as $row) {
            $start = strtotime($date . ' ' . $row->StartTime);
            $end = strtotime($date . ' ' . $row->EndTime) - ($service->DurationMinutes * 60);
            for ($t = $start; $t <= $end; $t += 15 * 60) {
                $timeSlots[] = [
                    'time' => date('H:i:s', $t),
                    'MechanicID' => $row->MechanicID
                ];
            }
        }

        // Filter out overbooked slots
        $available = [];

        foreach ($timeSlots as $slot) {
            $slotStart = $date . ' ' . $slot['time'];
            $slotEnd = date('Y-m-d H:i:s', strtotime($slotStart) + ($service->DurationMinutes * 60));

            $conflictCount = DB::table('Appointments')
                ->where('MechanicID', $slot['MechanicID'])
                ->where('AppointmentDateTime', '<', $slotEnd)
                ->whereRaw("DATE_ADD(AppointmentDateTime, INTERVAL ? MINUTE) > ?", [
                    $service->DurationMinutes, $slotStart
                ])
                ->count();

            if ($conflictCount === 0) {
                $available[] = substr($slot['time'], 0, 5); // HH:MM
            }
        }

        return response()->json(array_values(array_unique($available)));
    }
}