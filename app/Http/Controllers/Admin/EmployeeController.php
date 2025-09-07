<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function toggleStatus($id)
{
    $employees = Employee::findOrFail($id);
    $employees->status = $employees->status === 'active' ? 'inactive' : 'active';
    $employees->save();

    return redirect()->route('admin.employees.index')
        ->with('success', 'Employee status updated successfully!');
}

}