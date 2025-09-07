<x-layouts.guest_admin>
    <form method="POST" action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

       

       
        <button type="submit" class="btn btn-primary w-100">Login</button>
       
    </form>

    
</x-layouts.guest_admin>
