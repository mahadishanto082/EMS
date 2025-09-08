@extends('components.layouts.admin')

@section('title')
    Dashboard
@endsection

@section('_css')
<style>
.animated-greeting {
  opacity: 0;
  transform: translateX(-20px);
  animation: fadeSlideIn 1.5s forwards;
  
  font-weight: bold;
  font-size: 2rem;
  color: #333;
}

@keyframes fadeSlideIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>
@endsection

@section('content')

    {{-- Greeting --}}
    <div style="display: flex; align-items: center; position: relative; height: 60px;">
      <h1 class="animated-greeting" style="margin: 0 auto; text-align: center; flex: 1;">
        Welcome back, Admin!
      </h1>
      <div class="date" style="position: absolute; right: 0; font-weight: bold;">
        {{ date('l, d M Y') }} <br>
        {{ date('h:i A') }}
      </div>
    </div>

    {{-- Page Title --}}
    <div class="br-pagetitle mt-4">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Dashboard</h4>
            <p class="mg-b-0">Here is today's information</p>
        </div>
    </div>

    {{-- Dashboard Cards --}}
    <div class="row mt-4">
        <!-- Total Employees -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Total Employees</h5>
                    <h3 class="fw-bold">120</h3> {{-- later dynamic --}}
                </div>
            </div>
        </div>

        <!-- Active Employees -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-user-check fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Active Employees</h5>
                    <h3 class="fw-bold">95</h3>
                </div>
            </div>
        </div>

        <!-- Leave Requests -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-calendar-days fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Leave Requests</h5>
                    <a href="{{ route('admin.leave_requests.index') }}" class="stretched-link text-decoration-none"></a>

                    <h3 class="fw-bold">8</h3>
                </div>
            </div>
        </div>

        <!-- Feedback -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-comment-dots fa-2x text-info mb-2"></i>
                    <h5 class="card-title">Feedback</h5>
                    <h3 class="fw-bold">15</h3>
                </div>
            </div>
        </div>
    </div>

@endsection
