<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    // Display a listing of all leave requests
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')->get();
        return view('admin.leave_requests.index', compact('leaveRequests'));
    }

    // Admin dashboard
  
    // Show the form for editing a specific leave request
    public function edit($id)
    {
        $leaveRequest = LeaveRequest::with('employee')->findOrFail($id);
        return view('admin.leave_requests.edit', compact('leaveRequest'));
    }

    // Update the specified leave request in storage
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Approved,Rejected,Pending',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = $request->status;
        $leaveRequest->save();

        return redirect()->route('admin.leave_requests.index')->with('success', 'Leave request updated successfully.');
    }
    public function approve($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'Approved';
        $leaveRequest->save();

        return redirect()->route('admin.leave_requests.index')->with('success', 'Leave request approved successfully.');
    }
    public function reject($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'Rejected';
        $leaveRequest->save();

        return redirect()->route('admin.leave_requests.index')->with('success', 'Leave request rejected successfully.');
    }
}
