<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateScheduleController extends Controller
{
    /**
     * Show the "Create Weekly Schedule" form (single shift add; blocks overlaps).
     */
    public function showForm()
    {
        $mechanics = DB::table('Mechanics')
            ->select('MechanicID', 'FirstName', 'LastName')
            ->orderBy('FirstName')->orderBy('LastName')
            ->get();

        return view('admin.schedule.create', compact('mechanics'));
    }

    /**
     * Store a new shift for a mechanic (no overwrite; overlap blocked).
     */
    public function store(Request $request)
    {
        $request->validate([
            'mechanicID' => ['required','integer', Rule::exists('Mechanics','MechanicID')],
            'dayOfWeek'  => ['required','string', Rule::in(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])],
            'startTime'  => ['required','date_format:H:i'],
            'endTime'    => ['required','date_format:H:i'],
        ]);

        $mechanicID = (int) $request->mechanicID;
        $day        = $request->dayOfWeek;
        $start      = $request->startTime; // "HH:MM"
        $end        = $request->endTime;   // "HH:MM"

        if ($end <= $start) {
            return back()->withInput()->with('error', 'End time must be after start time.');
        }
        if (!$this->isHalfHour($start) || !$this->isHalfHour($end)) {
            return back()->withInput()->with('error', 'Times must be on 30-minute increments.');
        }

        // Block overlaps
        $overlap = DB::table('Schedule')
            ->where('MechanicID', $mechanicID)
            ->where('DayOfWeek', $day)
            ->where(function ($q) use ($start, $end) {
                $q->where('StartTime', '<', $end)
                  ->where('EndTime',   '>', $start);
            })
            ->exists();

        if ($overlap) {
            return back()->withInput()
                ->with('error', 'That time range overlaps an existing shift. Use Manage Schedules to overwrite.');
        }

        $ok = DB::table('Schedule')->insert([
            'MechanicID' => $mechanicID,
            'DayOfWeek'  => $day,
            'StartTime'  => $start,
            'EndTime'    => $end,
        ]);

        return back()->with($ok ? 'success' : 'error',
            $ok ? '✅ Schedule added successfully!' : '❌ Failed to add schedule.'
        );
    }

    /**
     * Manage (single form): choose mechanic + day, then set/overwrite/clear.
     * GET /admin/schedule/edit  (name: admin.schedule.edit)
     */
    public function editAll()
    {
        $mechanics = DB::table('Mechanics')
            ->select('MechanicID','FirstName','LastName')
            ->orderBy('FirstName')->orderBy('LastName')
            ->get();

        return view('admin.schedule.manage', compact('mechanics'));
    }

    /**
     * Save from Manage form.
     * PUT /admin/schedule/update (name: admin.schedule.update)
     *
     * Fields:
     *  - mechanicID (int, required)
     *  - dayOfWeek  (Mon..Sun, required)
     *  - is_off     (bool, optional) -> clear all shifts that day
     *  - overwrite  (bool, optional) -> delete existing then insert this one
     *  - startTime, endTime (HH:MM, required unless is_off)
     */
    public function updateAll(Request $request)
    {
        $request->validate([
            'mechanicID' => ['required','integer', Rule::exists('Mechanics','MechanicID')],
            'dayOfWeek'  => ['required','string', Rule::in(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])],
            'is_off'     => ['nullable','boolean'],
            'overwrite'  => ['nullable','boolean'],
            'startTime'  => ['required_unless:is_off,1','nullable','date_format:H:i'],
            'endTime'    => ['required_unless:is_off,1','nullable','date_format:H:i'],
        ]);

        $mechanicID = (int) $request->mechanicID;
        $day        = $request->dayOfWeek;
        $isOff      = $request->boolean('is_off');
        $overwrite  = $request->boolean('overwrite');
        $start      = $request->startTime;
        $end        = $request->endTime;

        if ($isOff) {
            DB::table('Schedule')->where('MechanicID', $mechanicID)
                ->where('DayOfWeek', $day)
                ->delete();

            return back()->with('success', '✅ Day cleared (off).');
        }

        if ($end <= $start) {
            return back()->withInput()->with('error', 'End time must be after start time.');
        }
        if (!$this->isHalfHour($start) || !$this->isHalfHour($end)) {
            return back()->withInput()->with('error', 'Times must be on 30-minute increments.');
        }

        if ($overwrite) {
            // Replace whatever exists for that day
            DB::table('Schedule')->where('MechanicID', $mechanicID)
               ->where('DayOfWeek', $day)->delete();

            $ok = DB::table('Schedule')->insert([
                'MechanicID' => $mechanicID,
                'DayOfWeek'  => $day,
                'StartTime'  => $start,
                'EndTime'    => $end,
            ]);

            return back()->with($ok ? 'success' : 'error',
                $ok ? '✅ Shift saved (overwrote existing).' : '❌ Failed to save shift.');
        }

        // Non-overwrite: block overlaps
        $overlap = DB::table('Schedule')
            ->where('MechanicID', $mechanicID)
            ->where('DayOfWeek', $day)
            ->where(function ($q) use ($start, $end) {
                $q->where('StartTime', '<', $end)
                  ->where('EndTime',   '>', $start);
            })
            ->exists();

        if ($overlap) {
            return back()->withInput()->with('error',
                'That time range overlaps an existing shift. Check "Overwrite existing" to replace it.');
        }

        $ok = DB::table('Schedule')->insert([
            'MechanicID' => $mechanicID,
            'DayOfWeek'  => $day,
            'StartTime'  => $start,
            'EndTime'    => $end,
        ]);

        return back()->with($ok ? 'success' : 'error',
            $ok ? '✅ Shift added.' : '❌ Failed to add shift.');
    }

    /** HH:MM must be on :00 or :30 */
    private function isHalfHour(string $hhmm): bool
    {
        [$h,$m] = array_map('intval', explode(':', $hhmm));
        return in_array($m, [0,30], true) && $h >= 0 && $h <= 23;
    }
}