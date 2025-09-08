@extends('components.layouts.admin')

@section('title', 'Leave Requests')

@section('content')
<style>
/* Animated gradient background */
.leave-bg {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #001f54, #007bff, #b3e5fc, #ffffff);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}
</style>
<div class="leave-bg">
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Leave Requests</h3>
          </div>
          <div class="card-body">

            <!-- Success / Error Messages -->
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Leave Requests Table -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Email</th>
                  <th scope="col">Position</th>
                  <th scope="col">Reason</th>
                  <th scope="col">Status</th>
                  <th scope="col">Admin Feedback</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaveRequests as $key => $request)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $request->date ?? 'N/A' }}</td>
                  <td>{{ $request->employee->email ?? 'N/A' }}</td>
                  <td>{{ $request->employee->position ?? 'N/A' }}</td>
                  <td>{{ $request->reason ?? 'N/A' }}</td>
                  <td>
                    @if($request->status == 'Pending')
                      <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($request->status == 'Approved')
                      <span class="badge bg-success">Approved</span>
                    @elseif($request->status == 'Rejected')
                      <span class="badge bg-danger">Rejected</span>
                    @else
                      N/A
                    @endif
                  </td>
                  <td>{{ $request->admin_feedback ?? 'N/A' }}</td>
                  <td>
                  <form action="{{ route('admin.leave_requests.approve', $request->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-success">Approve</button>
</form>

<form action="{{ route('admin.leave_requests.reject', $request->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-danger">Reject</button>
</form>


                    <!-- Delete Button -->
                    <form action="{{ route('admin.leave_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this request?');">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
                @if($leaveRequests->isEmpty())
                <tr>
                  <td colspan="8" class="text-center">No leave requests found.</td>
                </tr>
                @endif
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection

                    

