<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;

class AdminAssignDeanDeptController extends Controller
{
    

// function to show User that has role is Deans 
    
public function index()
    {
        $deans = User::with('departments')
            ->whereHas('roles', fn($q) => $q->where('role_name', 'Dean'))
            ->get();

        return view('admin.assign_dean.index', compact('deans'));
    }

    
    // this function help admin to assign departmnet for deans
    public function edit($id)
    {
        $dean = User::with('departments', 'roles')->findOrFail($id);

        // security check
        if (!$dean->roles->pluck('role_name')->contains('Dean')) {
            abort(403);
        }

        $departments = Department::all();

        return view('admin.assign_dean.edit', compact('dean', 'departments'));
    }

    // update ddean department 

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:departments,id',
        ]);

        $dean = User::with('roles')->findOrFail($id);

        if (!$dean->roles->pluck('role_name')->contains('Dean')) {
            abort(403);
        }

        $dean->departments()->sync($request->department_ids ?? []);

        return redirect()
            ->route('admin.assign_dean.index')
            ->with('success', 'Departments updated successfully');
    }
}