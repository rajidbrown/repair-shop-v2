<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateScheduleController extends Controller
{
    public function showForm()
    {
        $mechanics = DB::table('Mechanics')->select('MechanicID', 'FirstName', 'LastName')->get();
        return view('admin.schedule.create', compact('mechanics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mechanicID' => 'required|integer',
            'dayOfWeek' => 'required|string',
            'startTime' => 'required',
            'endTime' => 'required',
        ]);

        $success = DB::table('Schedule')->insert([
            'MechanicID' => $request->mechanicID,
            'DayOfWeek' => $request->dayOfWeek,
            'StartTime' => $request->startTime,
            'EndTime' => $request->endTime,
        ]);

        return redirect()->back()->with($success ? 'success' : 'error', $success ? '✅ Schedule added successfully!' : '❌ Failed to add schedule.');
    }
}