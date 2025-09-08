@extends('components.layouts.website')
@section('title', 'Employee Dashboard')

@section('content')

<style>
/* Animated gradient background */
.dashboard-bg {
    height: 85vh;
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

/* Card buttons */
.dashboard-card {
    background: #fff;
    color: #222;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-align: center;
    border: none;
    cursor: pointer;
    transition: 0.3s;
    min-width: 150px;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}
</style>

<div class="dashboard-bg">
  <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 500px;">

    <!-- Profile -->
    <a href="{{ route('employee.profile') }}" class="dashboard-card" style="text-decoration: none;">
      <i class="fa-solid fa-user" style="font-size: 2.5rem; color:#00AEEF; margin-bottom: 10px;"></i>
      <p style="font-weight:600; margin: 10px 0 0;">Profile</p>
    </a>

    <!-- Attendance -->
    <button type="button" class="dashboard-card" data-bs-toggle="modal" data-bs-target="#attendanceModal">
        <i class="fa-solid fa-calendar-check" style="font-size: 2.5rem; color:#00AEEF;"></i>
        <p style="font-weight:600; margin:10px 0 0;">Attendance</p>
    </button>

    <!-- Attendance Modal -->
    <!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">Mark Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="attendanceForm">
          <div class="mb-3">
            <label for="attendanceDate" class="form-label">Date</label>
            <input type="text" class="form-control" id="attendanceDate" value="{{ \Carbon\Carbon::today()->toDateString() }}" readonly>
          </div>

          <div class="mb-3">
            <label for="timeSlot" class="form-label">Time Slot</label>
            <select class="form-select" id="timeSlot">
    @if(isset($slots) && count($slots) > 0)
        @foreach($slots as $slot)
            <option value="{{ $slot->id }}" 
                @if(isset($currentSlotId) && $slot->id == $currentSlotId) selected @endif>
                {{ $slot->name }} ({{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }})
            </option>
        @endforeach
    @else
        <option value="morning" selected>Morning (09:30 AM - 6:30 PM)</option>
    @endif
</select>




          </div>

          <div class="mb-3">
    <label class="form-label">Today's Status</label>
    @if(isset($todayAttendance) && $todayAttendance)
        <p>Checked In: {{ $todayAttendance->check_in ?? 'Not yet' }}</p>
        <p>Checked Out: {{ $todayAttendance->check_out ?? 'Not yet' }}</p>
    @else
        <p>No attendance recorded for today.</p>
    @endif
</div>

<div class="d-flex justify-content-between mt-4">
    <button type="button" class="btn btn-success" id="checkInBtn"
        @if(isset($todayAttendance) && $todayAttendance->check_in) disabled @endif>
        Check In
    </button>

    <button type="button" class="btn btn-danger" id="checkOutBtn"
        @if(isset($todayAttendance) && $todayAttendance->check_out) disabled @endif>
        Check Out
    </button>
</div>

        </form>
        <div id="attendanceMsg" class="mt-3 text-center" style="display:none;"></div>
      </div>
    </div>
  </div>
</div>

    <!-- Leave -->
    <button type="button" class="dashboard-card btn btn-light" data-bs-toggle="modal" data-bs-target="#leaveModal">
        <i class="fa-solid fa-plane-departure" style="font-size: 2.5rem; color:#00AEEF;"></i>
        <p style="font-weight:600; margin: 10px 0 0;">Leave</p>
    </button>

    <!-- Leave Modal -->
    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leaveModalLabel">Leave Dashboard</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="leaveForm" action="{{ route('leave_requests.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                  <label for="date" class="form-label">Leave Date</label>
                  <input type="date" name="date" id="date" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ Auth::guard('employee')->user()->email }}" readonly>
              </div>
              <div class="mb-3">
                  <label for="position" class="form-label">Position</label>
                  <input type="text" name="position" id="position" class="form-control" value="{{ Auth::guard('employee')->user()->position }}" readonly>
              </div>
              <div class="mb-3">
                  <label for="message" class="form-label">Reason</label>
                  <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit Leave Request</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Toast Notifications -->
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
  <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ✅ {{ session('success') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toastEl = document.getElementById('successToast');
      if(toastEl){
          const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
          toast.show();
      }
  });
</script>
@endif

@if(session('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
  <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ❌ {{ session('error') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toastEl = document.getElementById('errorToast');
      if(toastEl){
          const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
          toast.show();
      }
  });
</script>
@endif

@endsection

@push('scripts')
<script>
  // Attendance date auto-fill
  document.getElementById('attendanceDate').value = new Date().toLocaleDateString();

  const msg = document.getElementById('attendanceMsg');

  document.getElementById('checkInBtn').addEventListener('click', function(){
      msg.style.display = 'block';
      msg.innerHTML = '<span class="text-success fw-bold">Checked In at ' + new Date().toLocaleTimeString() + '</span>';
  });

  document.getElementById('checkOutBtn').addEventListener('click', function(){
      msg.style.display = 'block';
      msg.innerHTML = '<span class="text-danger fw-bold">Checked Out at ' + new Date().toLocaleTimeString() + '</span>';
  });

  $(document).ready(function(){

    $('#checkInBtn').click(function(){
        let slotId = $('#timeSlot').val();

        $.ajax({
            url: "{{ route('attendance.checkin') }}",
            type: "POST",
            data: {
                slot_id: slotId,
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                $('#attendanceMsg').text(res.message).css('color','green').show();
                $('#checkInBtn').prop('disabled', true);
                $('#checkOutBtn').prop('disabled', false);
            },
            error: function(err){
                $('#attendanceMsg').text('Something went wrong').css('color','red').show();
            }
        });
    });

    $('#checkOutBtn').click(function(){
        let slotId = $('#timeSlot').val();

        $.ajax({
            url: "{{ route('attendance.checkout') }}",
            type: "POST",
            data: {
                slot_id: slotId,
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                if(res.success){
                    $('#attendanceMsg').text(res.message).css('color','green').show();
                    $('#checkOutBtn').prop('disabled', true);
                } else {
                    $('#attendanceMsg').text(res.message).css('color','red').show();
                }
            },
            error: function(err){
                $('#attendanceMsg').text('Something went wrong').css('color','red').show();
            }
        });
    });

});
</script>
@endpush
