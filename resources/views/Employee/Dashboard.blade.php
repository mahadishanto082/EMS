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
    <a href="{{ route('profile.index') }}" class="dashboard-card" style="text-decoration: none;">
    <i class="fa-solid fa-user" style="font-size: 2.5rem; color:#00AEEF; margin-bottom: 10px;"></i>
    <p style="font-weight:600; margin: 10px 0 0; ">Profile</p>
</a>


    <!-- Attendance -->
    <button onclick="location.href='attendance.html'" class="dashboard-card">
        <i class="fa-solid fa-calendar-check" style="font-size: 2.5rem; color:#00AEEF;"></i>
        <p style="font-weight:600; margin: 10px 0 0;">Attendance</p>
    </button>

    <!-- Leave -->
    <!-- Leave Button -->
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
  <form id="messageForm" method="POST" action="{{ route("leave_requests.store") }}">
    @csrf
    <!-- Date Field -->
    <div class="mb-3">
      <label for="date" class="form-label">Date</label>
      <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <!-- Position Field -->
    <div class="mb-3">
      <label for="position" class="form-label">Position</label>
      <input type="text" class="form-control" id="position" name="position" required>
    </div>

    <!-- Email Field -->
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <!-- Message Field -->
    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Send Message</button>
  </form>
</div>
<!-- Toast Notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
  <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ✅ Message Sent Successfully!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>




      </div>
      
    </div>
  </div>
</div>


  </div>
</div>
@endsection
@push('scripts')
<script>
  const messageForm = document.getElementById('messageForm');
  const toastEl = document.getElementById('successToast');
  const toast = new bootstrap.Toast(toastEl, { delay: 10000 }); // 10 seconds

  messageForm.addEventListener('submit', function(e) {
    // e.preventDefault(); // Uncomment if you want to prevent actual POST
    toast.show();
  });
</script>
@endpush
