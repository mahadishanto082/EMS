@extends('components.layouts.website')
@section('title', 'Edit Employee Profile')

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
            <h3 class="mb-0">Edit Employee Profile</h3>
          </div>
          <div class="card-body">

            <!-- Display Success/Error Messages -->
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('employee.profile.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <!-- Profile Image -->
              <div class="text-center mb-4">
                @if($employee->profile_image)
                  <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile Image" class="profile-picture mb-2">
                @else
                  <i class="fa-solid fa-user-circle" style="font-size: 120px; color: #00AEEF;"></i>
                @endif
              </div>

              <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" name="profile_image" class="form-control" id="profile_image">
              </div>

                          <!-- First Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="form-control" id="first_name" required>
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="form-control" id="last_name" required>
                </div>

                <!-- User Name -->
                <div class="mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input type="text" name="user_name" value="{{ old('user_name', $employee->user_name) }}" class="form-control" id="user_name" required>
                </div>
   <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control" id="email" required>
              </div>

              <!-- Phone -->
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $employee->phone_number) }}" class="form-control" id="phone">
              </div>

              <!-- Position -->
              <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="form-control" id="position">
              </div>
              <!-- Date of Birth -->
              <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}" class="form-control" id="date_of_birth">

             
              
             

              <!-- Buttons -->
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="{{ route('employee.profile') }}" class="btn btn-secondary">Cancel</a>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
