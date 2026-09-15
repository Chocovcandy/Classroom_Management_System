<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Auth;

class StudentClassworkController extends Controller
{
    /**
     * Show classwork for a class group.
     */
    public function index(ClassGroup $classGroup)
    {
        $student = Auth::user();

        // Make sure the student is enrolled in this class.
        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // Load all classwork belonging to this class.
        $classGroup->load([
            'course',

            'projects',

            'topics' => function ($query) {
                $query->with([
                    'materials',
                    'assignments',
                    'quizzes',
                    'exams',
                    'projects',
                ]);
            },
        ]);

        return view(
            'student.class_groups.classroom_group.classworks.index',
            compact('classGroup')
        );
    }
}
