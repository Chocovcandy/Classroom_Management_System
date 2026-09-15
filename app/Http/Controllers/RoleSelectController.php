<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectController extends Controller
{
    public function show()
    {
        $roles = Auth::user()->roles;

        return view('role.select', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required'],
        ]);

        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        // Check if the selected role belongs to this user
        $role = $user->roles
            ->where('role_name', $request->role)
            ->first();

        if (!$role) {
            abort(403, 'Invalid role selected');
        }

        // Save the selected role
        session([
            'current_role' => $role->id,
            'current_role_name' => $role->role_name,
        ]);

        // Redirect to the selected role dashboard
        return $this->redirectToRoleDashboard($role->role_name);
    }

    public function dashboard()
    {
        $roleName = session('current_role_name');

        if (!$roleName) {
            return redirect()->route('role.select');
        }

        return $this->redirectToRoleDashboard($roleName);
    }

    private function redirectToRoleDashboard(string $roleName)
    {
        return match (strtolower(trim($roleName))) {
            'admin' => redirect()->route('admin.dashboard'),

            'hod' => redirect()->route('hod.dashboard'),

            'professor' => redirect()->route('professor.dashboard'),

            'student' => redirect()->route('student.dashboard'),

            default => redirect()
                ->route('role.select')
                ->withErrors([
                    'role' => 'Your selected role does not have a dashboard.',
                ]),
        };
    }
}