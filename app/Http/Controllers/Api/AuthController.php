<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (! $employee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Salted password verify
        $hashedInput = hash('sha256', $request->password . $employee->password_salt);

        if ($hashedInput !== $employee->password) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Generate Sanctum token
        $token = $employee->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'employee' => $employee,
        ]);
    }
}
