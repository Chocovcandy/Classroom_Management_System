<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

class RoleSelectController extends Controller
{
    public function show() {
        $roles = Auth::user()->roles;
        return view('role.select', compact('roles'));
    }

   public function store(Request $request)
{
    $request->validate([
        'role' => 'required',
    ]);

    $user = Auth::user();

    if (!$user) {
        abort(401);
    }
    // Check if the selected role is valid for the user

    $role = $user->roles
        ->where('role_name', $request->role)
        ->first();
// If the role is not valid, abort with 403
    if (!$role) {
        abort(403, 'Invalid role selected');
    }
// Store the selected role in the session
    session(['current_role' => $role->id]);
// Redirect to the right dashboard based on the selected role
    return match ($role->role_name) {
        'Admin' => redirect()->route('admin.dashboard'),
        'Dean' => redirect()->route('dean.dashboard'),
        'HoD' => redirect()->route('hod.dashboard'),
        'Professor' => redirect()->route('professor.dashboard'),
        'Student' => redirect()->route('student.dashboard'),
        default => abort(403),
    };
}
}