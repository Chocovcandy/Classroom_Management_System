<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Show all departments
     */
    public function index()
    {
        $departments = Department::all();

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store new department
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create([
            'department_name' => $request->department_name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update department
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department->update([
            'department_name' => $request->department_name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department updated successfully');
    }

    /**
     * Delete department
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department deleted successfully');
    }
}