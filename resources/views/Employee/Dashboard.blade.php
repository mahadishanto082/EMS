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
      <form action=" #" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>

      </div>
      
    </div>
  </div>
</div>


  </div>
</div>
@endsection
