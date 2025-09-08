<aside class="bg-primary text-white vh-100 shadow p-3" style="width: 250px;">
    <nav class="nav flex-column">

        <!-- Dashboard -->
        <a href="{{ route('admin.home') }}" class="nav-link text-white d-flex align-items-center">
            <i class="fa-solid fa-house me-2"></i>
            Dashboard
        </a>

       

        <!-- Employee -->
        <div class="nav-item">
            <button class="btn btn-toggle align-items-center rounded w-100 d-flex justify-content-between text-white px-2 py-2"
                data-bs-toggle="collapse" data-bs-target="#employee-collapse" aria-expanded="false">
                <span><i class="fa-solid fa-users me-2"></i> Employee</span>
                <i class="fa-solid fa-chevron-down small"></i>
            </button>
            <div class="collapse ps-4" id="employee-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-light nav-link px-2 py-1">Add Employee</a></li>
                    <li><a href="{{ route('admin.employees.index') }}" class="link-light nav-link px-2 py-1">Employee List</a></li>
                </ul>
            </div>
        </div>

        <!-- Attendance Tracking -->
        <div class="nav-item">
            <button class="btn btn-toggle align-items-center rounded w-100 d-flex justify-content-between text-white px-2 py-2"
                data-bs-toggle="collapse" data-bs-target="#attendance-collapse" aria-expanded="false">
                <span><i class="fa-solid fa-calendar-check me-2"></i> Attendance</span>
                <i class="fa-solid fa-chevron-down small"></i>
            </button>
            <div class="collapse ps-4" id="attendance-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-light nav-link px-2 py-1">Track Attendance</a></li>
                    <li><a href="{{ route('admin.attendance.create') }}" class="link-light nav-link px-2 py-1">Create Attendance</a></li>
                    <li><a href="{{ route('admin.slots.create') }}" class="link-light nav-link px-2 py-1">Create Slot</a></li>
                </ul>
            </div>
        </div>

        <!-- Settings -->
        <a href="" class="nav-link text-white d-flex align-items-center">
            <i class="fa-solid fa-gear me-2"></i>
            Settings
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.leave_requests.index') }}" class="nav-link text-white d-flex align-items-center">
            <i class="fa-regular fa-envelope me-2"></i>
            Messages
        </a>

    </nav>
</aside>
