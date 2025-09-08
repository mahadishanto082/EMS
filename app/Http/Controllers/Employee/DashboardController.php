<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Slot;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $slots = Slot::all(); // fetch all slots

        $employeeId = Auth::id();
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('date', Carbon::today())
            ->first();
    
        $currentSlotId = $slots->first()->id ?? null;
    
        return view('employee.dashboard', [
            'slots' => $slots,
            'todayAttendance' => $todayAttendance,
            'currentSlotId' => $currentSlotId,
        ]);
    }
    
    // Handle Check-In
    public function checkIn(Request $request)
    {
        $employeeId = Auth::id();
        $slotId = $request->slot_id;

        $attendance = Attendance::firstOrCreate(
            [
                'employee_id' => $employeeId,
                'slot_id' => $slotId,
                'date' => Carbon::today()->toDateString(),
            ],
            [
                'check_in' => now(),
            ]
        );

        if ($attendance->wasRecentlyCreated || !$attendance->check_in) {
            $attendance->check_in = now();
            $attendance->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Checked in successfully!',
            'check_in' => $attendance->check_in->format('H:i:s'),
        ]);
    }

    // Handle Check-Out
    public function checkOut(Request $request)
    {
        $employeeId = Auth::id();
        $slotId = $request->slot_id;

        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('slot_id', $slotId)
            ->whereDate('date', Carbon::today())
            ->first();

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'You have not checked in yet.']);
        }

        $attendance->check_out = now();
        $attendance->save();

        return response()->json([
            'success' => true,
            'message' => 'Checked out successfully!',
            'check_out' => $attendance->check_out->format('H:i:s'),
        ]);
    }
}
