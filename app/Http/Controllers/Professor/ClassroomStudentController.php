<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ClassroomStudentController extends Controller
{
    /**
     * Display students enrolled in the classroom.
     */
    public function index(ClassGroup $classGroup)
    {
        Gate::authorize('view', $classGroup);

        $classGroup->load([
            'course',
            'students',
        ]);

        return view(
            'professor.class_groups.classroom_group.students.index',
            compact('classGroup')
        );
    }


    /**
     * Remove a student from the classroom.
     */
    public function remove(ClassGroup $classGroup, User $student)
    {
        Gate::authorize('view', $classGroup);

        $classGroup->students()->detach($student->id);

        return back()->with(
            'success',
            'Student removed from the class successfully.'
        );
    }
}

