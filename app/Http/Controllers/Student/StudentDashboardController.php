<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | STUDENT COURSES
        |--------------------------------------------------------------------------
        */

        $classGroups = ClassGroup::with([
            'professor'
        ])
        ->withCount('students')
        ->whereHas('students', function ($query) use ($student) {

            $query->where('users.id', $student->id);

        })
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL COURSES
        |--------------------------------------------------------------------------
        */

        $totalCourses = $classGroups->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PROFESSORS
        |--------------------------------------------------------------------------
        */

        $totalProfessors = $classGroups
            ->pluck('professor_id')
            ->filter()
            ->unique()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL STUDENTS
        |--------------------------------------------------------------------------
        */

        $totalStudents = $classGroups
            ->sum('students_count');


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD COUNTERS
        |--------------------------------------------------------------------------
        |
        | Keep these at 0 for now.
        | We will connect assignments, materials and announcements
        | after the classroom is working.
        |
        */

        $totalAssignments = 0;

        $totalMaterials = 0;

        $totalAnnouncements = 0;


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('student.dashboard', compact(
            'classGroups',
            'totalCourses',
            'totalProfessors',
            'totalStudents',
            'totalAssignments',
            'totalMaterials',
            'totalAnnouncements'
        ));
    }
}