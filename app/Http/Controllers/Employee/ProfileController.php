<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee; // make sure this model points to your actual table
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class ProfileController extends Controller
{
    // Show logged-in employee profile
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        return view('Employee.profile.index', compact('employee'));
    }

    // Edit logged-in employee profile
    public function edit()
    {
        $employee = Auth::guard('employee')->user();
        return view('Employee.profile.edit', compact('employee'));
    }

    // Update logged-in employee profile
    public function update(Request $request)
    {
        $employee = Auth::guard('employee')->user();

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employee,email,' . $employee->id],
            'user_name' => ['nullable', 'string', 'max:255', 'unique:employee,user_name,' . $employee->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->user_name = $request->user_name;
        $employee->phone_number = $request->phone_number;
        $employee->position = $request->position;
        $employee->date_of_birth = $request->date_of_birth;


       

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($employee->profile_image && Storage::disk('public')->exists($employee->profile_image)) {
                Storage::disk('public')->delete($employee->profile_image);
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'profile_images/' . $imageName;

            $resizedImage = Image::make($image)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($image->getClientOriginalExtension(), 80);

            Storage::disk('public')->put($imagePath, (string)$resizedImage);
            $employee->profile_image = $imagePath;
        }

        $employee->update(); // Use update method instead of save

        return redirect()->route('employee.profile')->with('success', 'Profile updated successfully.');
    }
}
