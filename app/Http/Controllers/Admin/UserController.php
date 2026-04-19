<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UserAssignmentService;

class UserController extends Controller
{
    /**
     * Show create user form
     */
    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all(),
            'departments' => Department::all(),
        ]);
    }

    public function index()
    {
        $users = User::with('roles', 'departments')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store new user created by admin
     */


public function store(Request $request, UserAssignmentService $service)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role_id' => 'required|exists:roles,id',
        'department_ids' => 'nullable|array',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $role = Role::findOrFail($request->role_id);

    $service->assignRoleAndDepartment(
        $user,
        $role,
        $request->department_ids
    );

    return redirect()->route('admin.users.index')->with('success', 'User created successfully');
}
// show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'departments' => Department::all(),
        ]);
    }   
// update user
    public function update(Request $request, User $user)
    {
        // 1. Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],                
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'min:6'],
            'role_id' => ['required', 'exists:roles,id'],       
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        // 2. Update user details       
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // 3. Sync role
        $role = Role::findOrFail($request->role_id);
        $user->roles()->sync([$role->id]);
        // 4. Sync department (only if selected)
        if ($request->filled('department_id')) {
            $user->departments()->sync([$request->department_id]);

        } else {
            $user->departments()->detach();
        }                           
        return redirect()->route('admin.users.index')
        
            ->with('success', 'User updated successfully');
    }


    // delete user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'User deleted successfully');
    }   
}