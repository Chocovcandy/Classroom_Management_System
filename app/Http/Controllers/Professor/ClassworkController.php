<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Gate;

class ClassworkController extends Controller
{
    /**
     * Display the classwork page.
     */
    public function index(ClassGroup $classGroup)
    {
        /*
        |--------------------------------------------------------------------------
        | Authorize access
        |--------------------------------------------------------------------------
        */

        Gate::authorize('view', $classGroup);


        /*
        |--------------------------------------------------------------------------
        | Load classwork organized by topic
        |--------------------------------------------------------------------------
        */

        $classGroup->load([
            'course',

            'topics.materials',
            'topics.assignments',
            'topics.quizzes',
            'topics.exams',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return Classwork page
        |--------------------------------------------------------------------------
        */

        return view(
            'professor.class_groups.classroom_group.classworks.index',
            compact('classGroup')
        );
    }
}