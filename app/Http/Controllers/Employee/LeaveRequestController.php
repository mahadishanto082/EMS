<?php
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class LeaveRequestController extends Controller
{
    // Display a listing of the leave requests for the authenticated employee
    public function index()
    {
        $employeeId = Auth::id();
        $leaveRequests = LeaveRequest::where('employee_id', $employeeId)->get();
        return view('Employee.leave_requestindex', compact('leaveRequests'));
    }

    // Show the form for creating a new leave request
    public function create()
    {
        return view('employee.leave_requests.create');
    }

    // Store a newly created leave request in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $leaveRequest = new LeaveRequest();
        $leaveRequest->employee_id = Auth::id();
        $leaveRequest->start_date = $request->start_date;
        $leaveRequest->end_date = $request->end_date;
        $leaveRequest->reason = $request->reason;
        $leaveRequest->status = 'Pending';
        $leaveRequest->save();

        return redirect()->route('employee.leave_requests.index')->with('success', 'Leave request submitted successfully.');
    }

    // Display the specified leave request
    public function show($id)
    {
        $employeeId = Auth::id();
        $leaveRequest = LeaveRequest::where('id', $id)->where('employee_id', $employeeId)->firstOrFail();
        return view('employee.leave_requests.show', compact('leaveRequest'));
    }
}