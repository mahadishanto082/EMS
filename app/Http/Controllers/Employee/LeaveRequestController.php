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
        'date' => 'required|date',
        'message' => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $employee = Auth::user(); // assuming you use default guard for employees

    $leaveRequest = new LeaveRequest();
    $leaveRequest->employee_id = $employee->id;
    $leaveRequest->date = $request->date;
    $leaveRequest->email = $employee->email; // optional
    $leaveRequest->position = $employee->position; // optional
    $leaveRequest->message = $request->message;
    $leaveRequest->status = 'Pending';
    $leaveRequest->save();

    return redirect()->route('leave_requests.index')->with('success', 'Leave request submitted successfully.');
}

public function edit($id)
    {
        $employeeId = Auth::id();
        $leaveRequest = LeaveRequest::where('id', $id)->where('employee_id', $employeeId)->firstOrFail();
        return view('employee.leave_requests.edit', compact('leaveRequest'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employeeId = Auth::id();
        $leaveRequest = LeaveRequest::where('id', $id)->where('employee_id', $employeeId)->firstOrFail();
        $leaveRequest->date = $request->date;
        $leaveRequest->message = $request->message;
        $leaveRequest->status = 'Pending'; // Reset status to Pending on update
        $leaveRequest->save();

        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated successfully.');
    }
    


    // Display the specified leave request
    public function show($id)
    {
        $employeeId = Auth::id();
        $leaveRequest = LeaveRequest::where('id', $id)->where('employee_id', $employeeId)->firstOrFail();
        return view('employee.leave_requests.show', compact('leaveRequest'));
    }

    public function destroy($id)
    {
        $employeeId = Auth::id();
        $leaveRequest = LeaveRequest::where('id', $id)->where('employee_id', $employeeId)->firstOrFail();
        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')->with('success', 'Leave request deleted successfully.');
    }
}