<?php

namespace App\Services;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Slot;
use App\Models\EmployeeSlot;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeService
{
    public function getDashboardData()
    {
        $totalEmployees = Employee::count();
        $totalAttendanceToday = Attendance::whereDate('date', Carbon::today())->count();
        $totalSlots = Slot::count();

        // Get attendance records for today with employee and slot details
        $attendanceRecords = Attendance::with(['employee', 'slot'])
            ->whereDate('date', Carbon::today())
            ->get();

        return [
            'totalEmployees' => $totalEmployees,
            'totalAttendanceToday' => $totalAttendanceToday,
            'totalSlots' => $totalSlots,
            'attendanceRecords' => $attendanceRecords,
        ];
    }
}