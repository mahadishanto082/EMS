<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredEmployeeController extends Controller
{
    /**
     * Show the registration page
     */
    public function create(): View
    {
        return view('Employee.auth.registration'); // ✅ 
    }

    /**
     * Handle registration
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:employee'],
            'user_name'         => ['required', 'string', 'max:255', 'unique:employee'],
            'phone_number'     => ['required', 'string', 'max:15'],
            'date_of_birth'    => ['required', 'date'],
            'position'         => ['required', 'string', 'max:255'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // generate a random salt
        $salt = bin2hex(random_bytes(16)); // 32 chars long salt

        // combine password + salt before hashing
        $hashedPassword = hash('sha256', $request->password . $salt);

        $employee = Employee::create([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'user_name'       => $request->user_name,
            'phone_number'   => $request->phone_number,
            'date_of_birth'  => $request->date_of_birth,
            'position'       => $request->position,
            'password'       => $hashedPassword,
            'password_salt'  => $salt,
        ]);

        event(new Registered($employee));

        Auth::guard('employee')->login($employee);

        return redirect()->route('employee.auth.login'); // redirects to employee login page

    }
}
