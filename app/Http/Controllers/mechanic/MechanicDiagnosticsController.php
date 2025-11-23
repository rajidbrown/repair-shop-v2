<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MechanicDiagnosticsController extends Controller
{
    public function index()
    {
        $mechanicID = session('mechanic_id');
        if (!$mechanicID) {
            return redirect()->route('login.mechanic');
        }

        // Fetch appointments with diagnostics & recommendation
        $appointments = DB::table('Appointments as A')
            ->join('Bikes as B', 'A.BikeID', '=', 'B.BikeID')
            ->join('Customers as C', 'A.CustomerID', '=', 'C.CustomerID')
            ->join('Services as S', 'A.ServiceID', '=', 'S.ServiceID')
            ->leftJoin('Diagnostics as D', function ($join) use ($mechanicID) {
                $join->on('D.AppointmentID', '=', 'A.AppointmentID')
                     ->where('D.MechanicID', '=', $mechanicID);
            })
            ->select(
                'A.AppointmentID',
                'A.AppointmentDateTime',
                'A.Diagnostics',
                'B.Year', 'B.Make', 'B.Model',
                'C.FirstName', 'C.LastName',
                'S.ServiceName',
                'D.Recommendation'
            )
            ->where('A.MechanicID', $mechanicID)
            ->where(function ($query) {
                $query->whereNull('A.Status')->orWhere('A.Status', '!=', 'Completed');
            })
            ->orderBy('A.AppointmentDateTime', 'asc')
            ->get();

        // Templates for diagnostics default text
        $diagnosticTemplates = [
            "Full Inspection" => "• Check brakes, lights, tires, fluids\n• Look for leaks, wear, damage\n• Test ride for performance\n• Review service history",
            "Brake Service" => "• Inspect pads, rotors, fluid\n• Test brake operation\n• Look for line wear or leaks",
            "Engine Diagnostic" => "• Check compression, spark plug\n• Scan for codes\n• Listen for unusual noise\n• Inspect air/fuel systems",
            "Electrical Diagnostic" => "• Test battery and charging\n• Check wiring and grounds\n• Verify lights, horn, indicators\n• Examine ignition system"
        ];

        return view('mechanic.diagnostics', compact('appointments', 'diagnosticTemplates'));
    }

    public function store(Request $request)
    {
        $mechanicID = session('mechanic_id');
        if (!$mechanicID) {
            return redirect()->route('login.mechanic');
        }

        $request->validate([
            'appointment_id' => 'required|integer',
            'diagnostics' => 'required|string',
            'recommendation' => 'required|string',
        ]);

        $appointmentID = $request->input('appointment_id');
        $diagnostics = $request->input('diagnostics');
        $recommendation = $request->input('recommendation');

        try {
            // Update diagnostics in Appointments
            DB::table('Appointments')
                ->where('AppointmentID', $appointmentID)
                ->where('MechanicID', $mechanicID)
                ->update(['Diagnostics' => $diagnostics]);

            // Insert or update Diagnostics record
            DB::table('Diagnostics')->updateOrInsert(
                ['AppointmentID' => $appointmentID, 'MechanicID' => $mechanicID],
                [
                    'IssueFound' => $diagnostics,
                    'Recommendation' => $recommendation,
                    'CreatedAt' => now()
                ]
            );

            return redirect()->back()->with('success', '✅ Diagnostic and recommendation saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Failed to save: ' . $e->getMessage());
        }
    }
}