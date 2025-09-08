<header class="navbar navbar-expand-lg navbar-dark bg-primary shadow px-4">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <div class="bg-white text-primary fw-bold rounded d-flex align-items-center justify-content-center me-2" style="width:32px; height:32px;">
        <img src="{{ asset('AYM_Transparent_Logo.png') }}" alt="Logo" style="width: 24px; height: 24px;">
      </div>
      <span class="fw-semibold">Admin Dashboard</span>
    </a>

    <!-- Right Side -->
    <ul class="navbar-nav ms-auto d-flex align-items-center">

      
</li>

</a>

</li>



      <!-- User Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         <i class="fa-regular fa-user-circle fs-4 me-2"></i>
          <span>
            {{ Auth::guard('admin')->user()->name }}
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</li>

        </ul>
      </li>
    </ul>
  </div>
</header>
