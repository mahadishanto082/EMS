@extends('components.layouts.admin')

@section('title', 'Attendance Records')

@section('_css')
<style>
.attendance-bg {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #001f54, #007bff, #b3e5fc, #ffffff);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}
</style>
@endsection

@section('content')
<div class="attendance-bg">
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Attendance Records</h3>
          </div>
          <div class="card-body">

            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('admin.attendance.create') }}" class="btn btn-success mb-3">Add Attendance</a>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Employee</th>
                  <th>Slot</th>
                  <th>Date</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($attendances as $key => $attendance)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $attendance->employee->first_name ?? 'N/A' }}</td>
                  <td>{{ $attendance->slot->name ?? 'N/A' }}</td>
                  <td>{{ \Carbon\Carbon::parse($attendance->check_in_time)->format('Y-m-d') ?? 'N/A' }}</td>
                  <td>{{ \Carbon\Carbon::parse($attendance->check_in_time)->format('H:i:s') ?? 'N/A' }}</td>
                  <td>{{ \Carbon\Carbon::parse($attendance->check_out_time)->format('H:i:s') ?? 'N/A' }}</td>
                  <td>{{ $attendance->status ?? 'N/A' }}</td>
                </tr>
                @endforeach
                @if($attendances->isEmpty())
                <tr>
                  <td colspan="7" class="text-center">No attendance records found.</td>
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
