<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentAssignmentController extends Controller
{
    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_ids' => 'required|array',
            'department_ids.*' => 'exists:departments,id',
        ]);

        $user = User::findOrFail($request->user_id);

        $role = $user->roles->first()?->role_name;

        if (!$role) {
            return back()->withErrors('User has no role.');
        }

        // RULES
        if ($role === 'HoD' || $role === 'Student') {
            if (count($request->department_ids) > 1) {
                return back()->withErrors($role . ' can only have 1 department.');
            }

            // force single assignment
            $user->departments()->sync([$request->department_ids[0]]);
        }

        elseif ($role === 'Dean') {
            // Dean can have multiple departments
            $user->departments()->sync($request->department_ids);
        }

        else {
            // default rule
            $user->departments()->sync($request->department_ids);
        }

        return back()->with('success', 'Department assigned successfully.');
    }

    // this method lets us to select multiple users and assign them to one or more departments at once, 
    //following the same rules as the single assignment method.
    // It validates that the user IDs and department IDs exist, then loops through each selected user and applies the appropriate assignment logic based on their role.

    public function bulkAssign(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'department_ids' => 'required|array',
            'department_ids.*' => 'exists:departments,id',
        ]);

        $users = User::whereIn('id', $request->user_ids)->get();

        foreach ($users as $user) {
            $role = $user->roles->first()?->role_name;

            if (!$role) {
                continue; // Skip users with no role
            }

            // RULES
            if ($role === 'HoD' || $role === 'Student') {
                if (count($request->department_ids) > 1) {
                    continue; // Skip if more than 1 department is selected for HoD or Student
                }

                // force single assignment
                $user->departments()->sync([$request->department_ids[0]]);
            }

            elseif ($role === 'Dean') {
                // Dean can have multiple departments
                $user->departments()->sync($request->department_ids);
            }

            else {
                // default rule
                $user->departments()->sync($request->department_ids);
            }
        }

        return back()->with('success', 'Departments assigned successfully.');
    }
}