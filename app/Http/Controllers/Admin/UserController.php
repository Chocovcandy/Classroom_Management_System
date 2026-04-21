<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    
// Index method to show all users with their roles
//why not show departments too> cuz still in disscussion  our database right not store the department_id in users table, and have Dean_department_id
// if we have a pivot table department_user to store the relationship between users and departments, then we can show the departments of each user,
// if we have a picvot table we need to use the relationship in the User model to get the departments of each user, and then pass it to the view. but for now,
// we will just show the roles of each user in the index page.
  public function index()
{
    return view('admin.users.index', [
        'users' => User::with('roles', 'department', 'deanDepartments')->get(),
    ]);
}

public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all(),
            'departments' => Department::all(),
        ]);
    }
    /**
     * STORE (UPDATED FOR MULTI-ROLE)
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role_ids' => 'required|array',
        'role_ids.*' => 'exists:roles,id',

        'department_id' => 'nullable|exists:departments,id',
        'department_ids' => 'nullable|array',
        'department_ids.*' => 'exists:departments,id',
    ]);

   $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => bcrypt($request->password),
    'department_id' => $request->department_id,
]);
// attach roles (many to many)
    $user->roles()->attach($request->role_ids);




    // dean pivot (only if exists)
    if (!empty($request->department_ids)) {
        $user->deanDepartments()->sync($request->department_ids);
    }

    return redirect()->route('admin.users.index')
        ->with('success', 'User created successfully');
}

    /**
     * EDIT
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'departments' => Department::all(),
        ]);
    }

    /**
     * UPDATE (UPDATED FOR MULTI-ROLE)
     */
   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        'password' => ['nullable', 'min:6'],
        'role_ids' => ['required', 'array'],
        'role_ids.*' => ['exists:roles,id'],

        'department_id' => 'nullable|exists:departments,id',
        'department_ids' => 'nullable|array',
        'department_ids.*' => 'exists:departments,id',
    ]);

    $user->update([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $request->filled('password')
        ? Hash::make($request->password)
        : $user->password,
    'department_id' => $request->department_id,
]);
    $user->roles()->sync($request->role_ids);


    // dean departments sync
    $user->deanDepartments()->sync($request->department_ids ?? []);

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully');
}


    /**
     * DELETE
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'User deleted successfully');
    }
}