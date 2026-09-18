<?php

namespace App\Http\Controllers\Hod;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    public function index()
    {
        $currentUser = User::findOrFail(Auth::id());

        $departmentId = $currentUser
            ->departments()
            ->value('departments.id');

        $professors = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'Professor');
        })
            ->whereHas('departments', function ($query) use ($departmentId) {
                $query->where('departments.id', $departmentId);
            })
            ->with('departments')
            ->latest()
            ->paginate(10);

        return view('hod.professor.index', compact(
            'currentUser',
            'professors'
        ));
    }
}