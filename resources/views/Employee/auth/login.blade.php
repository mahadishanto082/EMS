<x-layouts.guest>
    <form method="POST" action="{{ route('employee-login.store') }} " method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

       
        <button type="submit" class="btn btn-primary w-100">Login</button>
       
    </form>

     <div class="mb-4">
        <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Sign Up</a>
        </div>
</x-layouts.guest>
