<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
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
    public function show($id)
    {
     //
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email,' . $employee->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee->name = $request->name;
        $employee->email = $request->email;

        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

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

        $employee->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
