<x-layouts.guest>
<form method="POST" action="{{ route('register.store') }}">
    @csrf
    
    <!-- First & Last Name in a Row -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
    </div>

    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <input type="text" class="form-control" id="position" name="position" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Sign up</button>

    <div class="mb-3 mt-2 text-center">
        <span>Already Signed? <a href="#" class="text-decoration-none">Login</a></span> 
    </div>
</form>
</x-layouts.guest>
