<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AvailableTimesController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $serviceID = $request->query('serviceID');

        Log::info("API Called: date={$date}, serviceID={$serviceID}");

        if (empty($date) || empty($serviceID)) {
            return response()->json([]);
        }

        $dayOfWeek = date('l', strtotime($date));

        // Get service
        $service = DB::table('Services')
            ->select('DurationMinutes', 'ServiceName')
            ->where('ServiceID', $serviceID)
            ->first();

        if (!$service) {
            Log::info("No service found for ID {$serviceID}");
            return response()->json([]);
        }

        // Get mechanics' schedules for this service & day
        $schedules = DB::table('Schedule as s')
            ->join('Mechanics as m', 's.MechanicID', '=', 'm.MechanicID')
            ->where('s.DayOfWeek', $dayOfWeek)
            ->where('m.Specialty', $service->ServiceName)
            ->select('s.MechanicID', 's.StartTime', 's.EndTime')
            ->get();

        if ($schedules->isEmpty()) {
            Log::info("No schedules available for day {$dayOfWeek} and specialty {$service->ServiceName}");
            return response()->json([]);
        }

        // Build 15-minute time intervals
        $timeSlots = [];
        foreach ($schedules as $row) {
            $start = strtotime($date . ' ' . $row->StartTime);
            $end = strtotime($date . ' ' . $row->EndTime);
            $durationSec = $service->DurationMinutes * 60;

            for ($t = $start; $t <= $end - $durationSec; $t += 15 * 60) {
                $timeSlots[] = [
                    'time' => date('H:i:s', $t),
                    'MechanicID' => $row->MechanicID
                ];
            }
        }

        // Filter conflicting slots
        $available = [];

        foreach ($timeSlots as $slot) {
            $slotStart = "{$date} {$slot['time']}";
            $slotEnd = date('Y-m-d H:i:s', strtotime($slotStart) + ($service->DurationMinutes * 60));

            // SQLite-compatible conflict detection
            $conflictCount = DB::table('Appointments')
                ->where('MechanicID', $slot['MechanicID'])
                ->where('AppointmentDateTime', '<', $slotEnd)
                ->whereRaw(
                    "datetime(AppointmentDateTime, '+' || ? || ' minutes') > ?",
                    [$service->DurationMinutes, $slotStart]
                )
                ->count();

            if ($conflictCount === 0) {
                $available[] = substr($slot['time'], 0, 5); // HH:MM
            }
        }

        return response()->json(array_values(array_unique($available)));
    }
}