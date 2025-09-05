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


</style>

<div class="profile-bg">
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        
          <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Edit Employee Profile</h3>
          </div>
          <div class="card-body">

            <!-- Display Success/Error -->
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

            <form action="#" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="text-center mb-4">
                @if($employee->profile_image)
                  <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile Image" class="rounded-circle mb-2" style="width:120px;height:120px;object-fit:cover;">
                @else
                  <i class="fa-solid fa-user-circle" style="font-size: 120px; color: #00AEEF;"></i>
                @endif
              </div>

              <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" name="profile_image" class="form-control" id="profile_image">
              </div>

              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="form-control" id="name" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control" id="email" required>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="form-control" id="phone">
              </div>

              <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="form-control" id="position">
              </div>

              <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" name="department" value="{{ old('department', $employee->department) }}" class="form-control" id="department">
              </div>

              <div class="mb-3">
                <label for="joining_date" class="form-label">Date of Joining</label>
                <input type="date" name="joining_date" value="{{ old('joining_date', $employee->joining_date ? $employee->joining_date->format('Y-m-d') : '') }}" class="form-control" id="joining_date">
              </div>

              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                  <option value="Active" {{ $employee->status == 'Active' ? 'selected' : '' }}>Active</option>
                  <option value="Inactive" {{ $employee->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
