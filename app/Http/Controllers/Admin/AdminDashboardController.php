<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $mechanics = DB::table('Mechanics')
            ->orderBy('LastName')
            ->orderBy('FirstName')
            ->get();

        $schedule = DB::table('Schedule')->get();
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $scheduleGrid = [];

        foreach ($days as $day) {
            foreach ($mechanics as $mechanic) {
                $scheduleGrid[$day][$mechanic->MechanicID] = '';
            }
        }

        foreach ($schedule as $entry) {
            $day = $entry->DayOfWeek;
            $id = $entry->MechanicID;
            $start = date("g:i A", strtotime($entry->StartTime));
            $end = date("g:i A", strtotime($entry->EndTime));
            $scheduleGrid[$day][$id] = "$start – $end";
        }

        return view('admin.dashboard', [
        'mechanics' => $mechanics,
        'schedule_grid' => $scheduleGrid, // rename here
        ]);
    }
}