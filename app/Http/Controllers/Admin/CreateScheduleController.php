<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateScheduleController extends Controller
{
    public function showForm()
    {
        $mechanics = DB::table('Mechanics')
            ->select('MechanicID', 'FirstName', 'LastName')
            ->orderBy('FirstName')
            ->orderBy('LastName')
            ->get();

        return view('admin.schedule.create', compact('mechanics'));
    }

    public function store(Request $request)
    {
        // 1) Validate inputs
        $request->validate([
            'mechanicID' => ['required','integer', Rule::exists('Mechanics', 'MechanicID')],
            'dayOfWeek'  => ['required','string', Rule::in(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])],
            // from your Blade we post values like "07:30" — validate HH:MM 24h
            'startTime'  => ['required','date_format:H:i'],
            'endTime'    => ['required','date_format:H:i'],
        ]);

        $mechanicID = (int) $request->mechanicID;
        $day        = $request->dayOfWeek;
        $start      = $request->startTime; // "HH:MM"
        $end        = $request->endTime;   // "HH:MM"

        // 2) Business rule: end > start
        if ($end <= $start) {
            return back()
                ->withInput()
                ->with('error', 'End time must be after start time.');
        }

        // 3) Prevent overlapping shifts for the same mechanic/day
        // overlap when (existing.Start < newEnd) AND (existing.End > newStart)
        $hasOverlap = DB::table('Schedule')
            ->where('MechanicID', $mechanicID)
            ->where('DayOfWeek', $day)
            ->where(function ($q) use ($start, $end) {
                $q->where('StartTime', '<', $end)
                  ->where('EndTime',   '>', $start);
            })
            ->exists();

        if ($hasOverlap) {
            return back()
                ->withInput()
                ->with('error', 'This time range overlaps an existing schedule for that mechanic.');
        }

        // 4) Insert
        $ok = DB::table('Schedule')->insert([
            'MechanicID' => $mechanicID,
            'DayOfWeek'  => $day,
            'StartTime'  => $start,  // stored as "HH:MM"
            'EndTime'    => $end,
        ]);

        return back()->with($ok ? 'success' : 'error',
            $ok ? '✅ Schedule added successfully!' : '❌ Failed to add schedule.'
        );
    }
}