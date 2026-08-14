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
    public function index(Request $request)
    {
        // add paginate at the end of the query cuz we want that and it is where it belong 
        // then we organize by it id and ascending them (1 to n ).
        //why? because pagination is not gonna work if you dont tell it how they should organize the data. 
        // we cant select all dept like this (Department::all()->paginate) , 
        // then expect the pagination to to do with the data that we just query the controller to 
        //show from db. The pagination wont work until we tell them what to do.
        // for example you want to the pagination to show  the latest data from db come in the first row of the table in that pagination page.
        // then it will show the latest data we input come first in the first row of the table. Just simple as that girl :) 
        // If you dont trust me then run that select all from the dept like this 
        // department::all()->paginate;
        // this is give you 100% grantee error . Paginate will say "Tf u want me to do with that shit data. tell me what to do. you dummy!" 

        // for testing  but both can be write in different ways. like the below them in request form it represent what users to is request to our system to do things for them.
        // $departments = Department::orderBy('id','asc')->paginate(5);

        // $departments = Department::paginate(5);

        $query = Department::query();

        // Search
        if ($request->filled('search')) {
            $query->where('department_name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Sort
        switch ($request->sort) {

            case 'name_asc':
                $query->orderBy('department_name', 'asc');
                break;

            case 'name_desc':
                $query->orderBy('department_name', 'desc');
                break;

            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            default:
                $query->orderBy('id', 'asc');
        }

        $departments = $query->paginate(6)->withQueryString();


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
