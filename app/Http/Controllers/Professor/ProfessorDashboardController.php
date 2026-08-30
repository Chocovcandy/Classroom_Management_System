<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfessorDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Get class groups taught by this professor
        $classGroups = $user->teachingClassGroups()
            ->with([
                'course',
                'students'
            ])
            ->latest()
            ->take(3)
            ->get();

        return view('professor.dashboard', compact('classGroups'));
    }
}