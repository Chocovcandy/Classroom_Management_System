<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * INDEX
     * Show all users with their roles and departments.
     */
    public function index(Request $request)
    {
        $users = User::with(['roles', 'departments']);

        // =========================================
        // QUICK ROLE FILTER
        // =========================================

        if ($request->filled('role')) {

            if ($request->role === 'academic_staff') {

                /*
                Academic Staff includes:
                - HoD
                - Professor

                Dean has been removed from the system.
                */

                $users->whereHas('roles', function ($query) {
                    $query->whereIn('role_name', [
                        'HoD',
                        'Professor',
                    ]);
                });

            } else {

                // Single role filter
                $users->whereHas('roles', function ($query) use ($request) {
                    $query->where(
                        'role_name',
                        $request->role
                    );
                });
            }
        }

        // =========================================
        // ADVANCED MULTI-ROLE FILTER
        // =========================================

        if ($request->filled('roles')) {

            $users->whereHas('roles', function ($query) use ($request) {
                $query->whereIn(
                    'role_name',
                    $request->roles
                );
            });
        }

        // =========================================
        // SEARCH
        // =========================================

        if ($request->filled('search')) {

            $users->where(function ($query) use ($request) {

                $query->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'email',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        // =========================================
        // SORT
        // =========================================

        switch ($request->sort) {

            case 'name_asc':

                $users->orderBy('name', 'asc');

                break;

            case 'name_desc':

                $users->orderBy('name', 'desc');

                break;

            case 'newest':

                $users->orderBy('created_at', 'desc');

                break;

            case 'oldest':

                $users->orderBy('created_at', 'asc');

                break;
        }

        // =========================================
        // PAGINATION
        // =========================================

        $users = $users
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * CREATE
     * Show create user page.
     */
    public function create()
    {
        return view('admin.users.create', [

            /*
            Student accounts are created through
            the registration page.
            */
            'roles' => Role::where(
                'role_name',
                '!=',
                'Student'
            )->get(),

            /*
            Kept for future use.
            */
            'departments' => Department::all(),
        ]);
    }

    /**
     * STORE
     * Save a new user.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required',

            'role_ids' => 'required|array',

            'role_ids.*' => 'exists:roles,id',

            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =========================================
        // HANDLE PROFILE IMAGE
        // =========================================

        $imagePath = null;

        if ($request->hasFile('profile_image')) {

            $imagePath = $request
                ->file('profile_image')
                ->store('profile_images', 'public');
        }

        // =========================================
        // CREATE USER
        // =========================================

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt($request->password),

            'profile_image' => $imagePath,
        ]);

        // =========================================
        // ASSIGN ROLES
        // =========================================

        $user->roles()->sync($request->role_ids);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * EDIT
     * Show edit user page.
     */
    public function edit(User $user)
    {
        // Block admin from editing student accounts
        if ($user->isStudent()) {

            return back()->with(
                'error',
                'You cannot edit student accounts'
            );
        }

        return view('admin.users.edit', [

            'user' => $user->load('roles', 'departments'),

            'roles' => Role::all(),

            'departments' => Department::all(),
        ]);
    }

    /**
     * UPDATE
     * Update an existing user.
     */
    public function update(Request $request, User $user)
    {
        // =========================================
        // BLOCK STUDENT UPDATE
        // =========================================

        if ($user->isStudent()) {

            return back()->with(
                'error',
                'You cannot update student accounts'
            );
        }

        // =========================================
        // PROTECT ADMIN ROLES
        // =========================================

        /*
        Admin users must keep their existing roles.
        */
        if ($user->isAdmin()) {

            $request->merge([

                'role_ids' => $user
                    ->roles
                    ->pluck('id')
                    ->toArray(),
            ]);
        }

        // =========================================
        // VALIDATION
        // =========================================

        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'password' => 'nullable|min:6|confirmed',

            'role_ids' => 'required|array',

            'role_ids.*' => 'exists:roles,id',
        ]);

        // =========================================
        // UPDATE BASIC INFORMATION
        // =========================================

        $user->update([

            'name' => $request->name,

            'email' => $request->email,

            /*
            Only update password when a new password
            has been entered.
            */
            'password' => $request->filled('password')

                ? Hash::make($request->password)

                : $user->password,
        ]);

        // =========================================
        // UPDATE ROLES
        // =========================================

        $user->roles()->sync($request->role_ids);

        /*
        Department assignment has been removed because
        Dean has been removed from the system.
        */

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * DELETE
     * Delete a user.
     */
    public function destroy(User $user)
    {
        // Prevent deleting your own account
        if ($user->id === Auth::id()) {

            return back()->with(
                'error',
                'You cannot delete your own account'
            );
        }

        // Prevent deleting an admin account
        if ($user->isAdmin()) {

            return back()->with(
                'error',
                'Cannot delete admin'
            );
        }

        // Delete user
        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully'
        );
    }
}