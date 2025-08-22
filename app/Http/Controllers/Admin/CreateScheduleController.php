<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateScheduleController extends Controller
{
    /**
     * Show the "Create Weekly Schedule" form.
     */
    public function showForm()
    {
        $mechanics = DB::table('Mechanics')
            ->select('MechanicID', 'FirstName', 'LastName')
            ->orderBy('FirstName')
            ->orderBy('LastName')
            ->get();

        return view('admin.schedule.create', compact('mechanics'));
    }

    /**
     * Store a new shift for a mechanic.
     * This *does not* overwrite overlaps—overrides are done in the
     * dedicated Edit Schedule UI.
     */
    public function store(Request $request)
    {
        // 1) Validate basic shape
        $request->validate([
            'mechanicID' => ['required', 'integer', Rule::exists('Mechanics', 'MechanicID')],
            'dayOfWeek'  => ['required', 'string', Rule::in(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])],
            // values come in like "09:00", "17:30" from the select
            'startTime'  => ['required', 'date_format:H:i'],
            'endTime'    => ['required', 'date_format:H:i'],
        ]);

        // Normalize inputs
        $mechanicID = (int) $request->mechanicID;
        $day        = $request->dayOfWeek;
        $start      = $request->startTime; // "HH:MM"
        $end        = $request->endTime;   // "HH:MM"

        // 2) Enforce end > start
        if ($end <= $start) {
            return back()
                ->withInput()
                ->with('error', 'End time must be after start time.');
        }

        // 3) Enforce 30-minute increments (to match the UI options)
        foreach ([$start, $end] as $t) {
            [$h, $m] = array_map('intval', explode(':', $t));
            if (!in_array($m, [0, 30], true)) {
                return back()
                    ->withInput()
                    ->with('error', 'Times must be on 30-minute increments.');
            }
        }

        // 4) Prevent overlap for the same mechanic/day
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
                ->with('error', 'That time range overlaps an existing shift for this mechanic. Use the Edit Schedule page to override.');
        }

        // 5) Insert (only existing columns)
        $ok = DB::table('Schedule')->insert([
            'MechanicID' => $mechanicID,
            'DayOfWeek'  => $day,
            'StartTime'  => $start, // stored as "HH:MM"
            'EndTime'    => $end,
        ]);

        return back()->with(
            $ok ? 'success' : 'error',
            $ok ? '✅ Schedule added successfully!' : '❌ Failed to add schedule.'
        );
    }
}