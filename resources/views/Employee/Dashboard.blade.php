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
    <button onclick="location.href='profile.html'" class="dashboard-card">
        <i class="fa-solid fa-user" style="font-size: 2.5rem; color:#00AEEF; margin-bottom: 10px;"></i>
        <p style="font-weight:600; margin: 10px 0 0;">Profile</p>
    </button>

    <!-- Attendance -->
    <button onclick="location.href='attendance.html'" class="dashboard-card">
        <i class="fa-solid fa-calendar-check" style="font-size: 2.5rem; color:#00AEEF;"></i>
        <p style="font-weight:600; margin: 10px 0 0;">Attendance</p>
    </button>

    <!-- Leave -->
    <button onclick="location.href='leave.html'" class="dashboard-card">
        <i class="fa-solid fa-plane-departure" style="font-size: 2.5rem; color:#00AEEF;"></i>
        <p style="font-weight:600; margin: 10px 0 0;">Leave</p>
    </button>

  </div>
</div>
@endsection
