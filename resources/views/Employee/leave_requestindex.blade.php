@extends('components.layouts.website')
@section('title', 'Leave Requests')

@section('content')
<style>
.leave-bg {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #001f54, #007bff, #b3e5fc, #ffffff);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}
@keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
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

            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Admin Feedback</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaveRequests as $index => $request)
                <tr>
                  <th>{{ $index + 1 }}</th>
                  <td>{{ $request->date ?? 'N/A' }}</td>
                  <td>{{ $request->email ?? 'N/A' }}</td>
                  <td>{{ $request->position ?? 'N/A' }}</td>
                  <td>{{ $request->message ?? 'N/A' }}</td>
                  <td>
                    @if(strtolower($request->status) === 'pending')
                      <span class="badge bg-warning text-dark">Pending</span>
                    @elseif(strtolower($request->status) === 'approved')
                      <span class="badge bg-success">Approved</span>
                    @elseif(strtolower($request->status) === 'rejected')
                      <span class="badge bg-danger">Rejected</span>
                    @else
                      <span class="badge bg-secondary">Unknown</span>
                    @endif
                  </td>
                  <td>{{ $request->admin_feedback ?? 'N/A' }}</td>
                  <td>
                    <!-- Edit Modal Trigger -->
                    <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#leaveModal{{ $request->id }}">Edit</button>

                    <!-- Modal -->
                    <div class="modal fade" id="leaveModal{{ $request->id }}" tabindex="-1" aria-labelledby="leaveModalLabel{{ $request->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="leaveModalLabel{{ $request->id }}">Edit Leave Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('leave_requests.update', $request->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="mb-3">
                                <label for="date{{ $request->id }}" class="form-label">Leave Date</label>
                                <input type="date" name="date" id="date{{ $request->id }}" class="form-control" value="{{ $request->date }}" required>
                              </div>
                              <div class="mb-3">
                                <label for="message{{ $request->id }}" class="form-label">Reason</label>
                                <textarea name="message" id="message{{ $request->id }}" class="form-control" rows="3" required>{{ $request->message }}</textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Delete Button -->
                    <form action="{{ route('leave_requests.destroy', $request->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
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
