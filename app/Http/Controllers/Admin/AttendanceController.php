<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Display all attendance records
    public function index()
    {
        $attendances = Attendance::with(['employee','slot'])->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    // Show form to create new attendance
    public function create()
    {
        $employees = Employee::all();
        $slots = Slot::all();
        return view('admin.attendance.create', compact('employees','slots'));
    }

    // Store attendance (check-in or check-out)
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'slot_id' => 'required|exists:slots,id',
        ]);
    
        $slot = Slot::findOrFail($request->slot_id);
    
        Attendance::create([
            'employee_id' => $request->employee_id,
            'slot_id' => $slot->id,
            'check_in' => $slot->start_time,   // automatic assignment
            'check_out' => $slot->end_time,    // automatic assignment
            'date' => now()->toDateString(),
        ]);
    
        return redirect()->back()->with('success', 'Attendance assigned successfully!');
    }

    // Show form for editing a specific attendance record
    public function edit($id)
    {
        $attendance = Attendance::with(['employee','slot'])->findOrFail($id);
        return view('admin.attendance.edit', compact('attendance'));
    }

    // Update attendance record
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Present,Absent,On Leave',
            'check_in_time' => 'nullable|date_format:H:i:s',
            'check_out_time' => 'nullable|date_format:H:i:s',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attendance = Attendance::findOrFail($id);
        $attendance->status = $request->status;
        if ($request->check_in_time) {
            $attendance->check_in_time = Carbon::parse($request->check_in_time);
        }
        if ($request->check_out_time) {
            $attendance->check_out_time = Carbon::parse($request->check_out_time);
        }
        $attendance->save();

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance record updated successfully.');
    }
}
