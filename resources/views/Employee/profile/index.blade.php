@extends('components.layouts.website')
@section('title', 'Employee Profile')

@section('content')
<style>
/* Profile Page Styles */
.profile-bg {
    min-height: 85vh;
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

.profile-picture {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #00AEEF;
}
</style>

<div class="profile-bg">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Employee Profile</h3>
                    </div>
                    <div class="card-body">

                        <!-- Profile Picture -->
                        <div class="text-center mb-4">
                            @if($employee->profile_photo)
                                <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile Photo" class="profile-picture">
                            @else
                                <i class="fa-solid fa-user-circle" style="font-size: 120px; color: #00AEEF;"></i>
                            @endif
                        </div>

                        <!-- Profile Table -->
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">First Name:</th>
                                    <td>{{ $employee->first_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name:</th>
                                    <td>{{ $employee->last_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">User Name:</th>
                                    <td>{{ $employee->user_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email:</th>
                                    <td>{{ $employee->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone:</th>
                                    <td>{{ $employee->phone_number ?? 'N/A' }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Position:</th>
                                    <td>{{ $employee->position ?? 'N/A' }}</td>
                                </tr>
                                <tr></tr></tr>
                                    <th scope="row">Date of Birth:</th>
                                    <td>
                                        @if($employee->date_of_birth)
                                            {{ \Carbon\Carbon::parse($employee->date_of_birth)->format('d-m-Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                               
                                <tr>
                                    <th scope="row">Status:</th>
                                    <td>{{ $employee->status ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Edit Profile Button -->
                        <div class="text-center mt-4">
                            <a href="{{ route('Employee.profile.edit') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">Edit Profile</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
