<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Gate;

class ClassroomStudentsController extends Controller
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
}