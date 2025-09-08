<?php
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveRequestController extends Controller
{
    // Display a listing of the employee's leave requests
    public function index()
    {
        
        $employee = Auth::user();
        $leaveRequests = LeaveRequest::where('employee_id', $employee->id)->get();
        

        return view('employee.leave_requestindex', compact('leaveRequests'));
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
            'email' => 'required|email',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = Auth::user();

        LeaveRequest::create([
            'employee_id' => $employee->id,
            'date' => $request->date,
            'email' => $request->email,
            'position' => $request->position,
            'message' => $request->message,
            'status' => 'Pending',
        ]);

        return redirect()->route('employee.leave_requests.index')->with('success', 'Leave request submitted successfully.');
    }
}