<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectController extends Controller
{
    public function show() {
        $roles = Auth::user()->roles;
        return view('role.select', compact('roles'));
    }

    public function store(Request $request){
        $request->validate ([
            'role' => 'required',
        ]);
        $user = Auth::user();
        
        // Security : make sure selected role belong to user
        if (!$user->roles->pluck('role_name')->contains($request->role)) {
            abort(403, 'Invalid role selected');
        }

        session ([ 'current_role' => $request->role ]);
        return match ($request->role) {
            'Admin' => redirect()->route('admin.dashboard'),
            'Dean' => redirect()->route('dean.dashboard'),
            'HoD' => redirect()->route('hod.dashboard'),
            'Professor' => redirect()->route('professor.dashboard'),
            'Student' => redirect()->route('student.dashboard'),
           default => abort(403, ' role not recognized'),
         
        };
    }
}
