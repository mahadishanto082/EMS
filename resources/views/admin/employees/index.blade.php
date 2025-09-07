@extends('components.layouts.admin')
@section('title', 'Employee List')

@section('content')
    <div class="br-pagetitle mt-4">
        <i class="icon ion-ios-people-outline"></i>
        <div>
            <h4>Employee List</h4>
            <p class="mg-b-0">Manage all employees from here</p>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center bg-light">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="fa-solid fa-users me-2"></i> Employees
                </h5>
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus me-1"></i> Add Employee
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Date of Birth</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->user_name }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($employee->date_of_birth)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $employee->position }}</td>
                                    <td>
                                        @if ($employee->status === 'active')
                                            <span class="badge bg-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            {{-- Edit --}}
                                            <a href="#" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            {{-- Activate / Deactivate --}}
                                            <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($employee->status === 'active')
                                                    <button type="submit" class="btn btn-sm btn-secondary">
                                                        <i class="fa-solid fa-user-slash"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa-solid fa-user-check"></i>
                                                    </button>
                                                @endif
                                            </form>

                                            {{-- Delete --}}
                                            <form action="#"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
