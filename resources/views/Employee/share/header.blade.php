<nav class="navbar navbar-expand-lg" style="background-color: #b3e5fc;" data-bs-theme="light">
  <div class="container-fluid">
    <img src="{{ asset('AYM_Transparent_Logo.png') }}" alt="Logo" width="80" class="me-3">
    <button class="navbar-toggler rounded-pill px-3 py-2 border-0 shadow-sm" 
      type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
      style="background-color: #ffffff;">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto gap-2">
  <!-- Home Button with Icon -->
  <li class="nav-item">
    <a class="fw-semibold btn btn-primary px-3 py-2 text-white" 
       style="border-radius: 10px;" 
       aria-current="page" href="{{ route('dashboard') }}">
       <i class="fa-solid fa-house"></i>
    </a>
  </li>

  <!-- Inbox Button with Icon -->
  <li class="nav-item">
    <a class="fw-semibold btn btn-info px-3 py-2 text-white" 
       style="border-radius: 10px;" 
       href={{ route('leave_requests.index') }}>
       <i class="fa-solid fa-inbox"></i>
    </a>
  </li>

  <!-- Logout Button with Icon -->
  <li class="nav-item">
    <form method="POST" action="{{ route('employee.logout') }}">
      @csrf
      <button type="submit" class="fw-semibold btn btn-danger px-3 py-2 text-white" 
              style="border-radius: 10px;">
        <i class="fa-solid fa-right-from-bracket"></i>
      </button>
    </form>
  </li>
</ul>


</div>

  </div>
</nav>
