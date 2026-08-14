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


    // Index method to show all users with their roles
    //why not show departments too> cuz still in disscussion  our database right not store the department_id in users table, and have Dean_department_id
    // if we have a pivot table department_user to store the relationship between users and departments, then we can show the departments of each user,
    // if we have a picvot table we need to use the relationship in the User model to get the departments of each user, and then pass it to the view. but for now,
    // we will just show the roles of each user in the index page.
    //   public function index()
    // {
    //     return view('admin.users.index', [
    //         'users' => User::with('roles', 'department', ')->get(),
    //     ])
    // }


    //----- correct-----

    public function index(Request $request)
    {
        $users = User::with(['roles', 'departments']);


            // NOTICE : academic_staff is not a real role in db, why we do this? cuz we want to group 
            // Dean, HoD , and prof call them by group (acedemic_staff) in order to show admin after they click "total Academic staff" on the dashboard.
            // Then the controller only group the Dean, HOd and prof under the name (academic staff). 
            // after than the controller group them (Dean , HoD ,and prof) in one page so that admin see all the academic staff. 
            
            
    // =========================================
    // QUICK ROLE FILTER
    // =========================================

    if ($request->filled('role')) {

        if ($request->role === 'academic_staff') {

            // Academic Staff = Dean + HoD + Professor

            $users->whereHas('roles', function ($query) {

                $query->whereIn('role_name', [
                    'Dean',
                    'HoD',
                    'Professor',
                ]);

            });

        } else {

            // Single role

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
        ->paginate(5)
        ->withQueryString();


    return view('admin.users.index', [
        'users' => $users,
    ]);
}

    public function create()
    {
        return view('admin.users.create', [
            //IMPORTANT: Student is excluded because it is system-generated THROUGH registration page
            'roles' => Role::where('role_name', '!=', 'Student')->get(),

            //Kept for future use, but NOT used in create form (since admin does not assign only for dean departments here)
            'departments' => Department::all(),
        ]);
    }


    /**
     * STORE 
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

        // Handle profile image upload if provided
        $imagePath = null;
        if ($request->hasFile('profile_image')) {

            $imagePath = $request->file('profile_image')
                ->store('profile_images', 'public');
        }
        
        // CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_image' => $imagePath,
        ]);

        // ASSIGN ROLES
        $user->roles()->sync($request->role_ids);





        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }


    /**
     * EDIT
     */
    public function edit(User $user)
    {
        //block admin from editing student info
        if ($user->isStudent()) {
            return back()->with('error', 'You cannot edit student accounts');
        }
        return view('admin.users.edit', [
            'user' => $user->load('roles', 'departments'),
            'roles' => Role::all(),
            'departments' => Department::all(),
        ]);
    }


    /**
     * UPDATE (UPDATED FOR MULTI-ROLE)
     */
    public function update(Request $request, User $user)
    {

        //  BLOCK STUDENT UPDATE
        if ($user->isStudent()) {
            return back()->with('error', 'You cannot update student accounts');
        }

        // Force Admin users to keep their existing roles, no matter what the form sends.
        if ($user->isAdmin()) {
            $request->merge([
                'role_ids' => $user->roles->pluck('id')->toArray()
            ]);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        // UPDATE BASIC INFO
        $user->update([
            'name' => $request->name,
            'email' => $request->email,

            // Only update password if provided
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);


        $user->roles()->sync($request->role_ids);

        $roles = $user->roles()->pluck('role_name');

        // ONLY DEAN can have departments (ADMIN RULE)
        if ($roles->contains('Dean')) {

            // assign multiple departments to Dean
            $user->departments()->sync($request->department_ids ?? []);
        } else {

            //IMPORTANT RULE:
            // If user is not Dean → remove all department links
            // because admin is not supposed to assign dept to anyone other than Dean
            $user->departments()->sync([]);
        }


        // if user is admin hide role
        $isAdmin = $user->roles->pluck('role_name')->contains('Admin');

        if ($isAdmin) {
            // lock roles (ignore any changes from form)
            $request->merge([
                'role_ids' => $user->roles->pluck('id')->toArray()
            ]);

            // prevent department changes too (extra safety)
            $user->departments()->sync($user->departments->pluck('id')->toArray());
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }



    /**
     * DELETE
     */
    public function destroy(User $user)
    {

        // if user is not authorized they cant delete account

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account');
        }
        // // if user is admin delete button will sent message to them so that they cant delete their own account.

        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete admin');
        }


        // Safe delete
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}
