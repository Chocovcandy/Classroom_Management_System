<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassGroup;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ClassGroupController extends Controller
{
    /**
     * Show all class groups taught by this professor.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $classGroups = $user->teachingClassGroups()
            ->with([
                'course',
                'students'
            ])
            ->latest()
            ->get();

        return view(
            'professor.class_groups.lists.index',
            compact('classGroups')
        );
    }


    /**
     * Show create class form.
     */
    public function create()
    {
        $courses = Course::orderBy('course_name')->get();

        return view(
            'professor.class_groups.create',
            compact('courses')
        );
    }


    /**
     * Create a new class group.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => [
                'required',
                'string',
                'max:255',
            ],

            'course_id' => [
                'required',
                'exists:courses,id',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate unique class code
        |--------------------------------------------------------------------------
        */

        do {
            $groupCode = 'CLS-' . strtoupper(Str::random(6));
        } while (
            ClassGroup::where('group_code', $groupCode)->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Create class group
        |--------------------------------------------------------------------------
        */

        $classGroup = ClassGroup::create([
            'group_name' => $validated['group_name'],

            'group_code' => $groupCode,

            'professor_id' => Auth::id(),

            'course_id' => $validated['course_id'],

            'description' => $validated['description'] ?? null,

            'status' => 'active',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Open newly created classroom
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Class created successfully.'
            );
    }


    /**
     * Open one class group classroom.
     */
    public function classroomGroup(ClassGroup $classGroup)
    {
        Gate::authorize('view', $classGroup);

        $classGroup->load([
            'course',
            'students',
            'announcements.user',
            'materials.user',
            'assignments',
            'quizzes',
            'exams',
            'topics',
        ]);

        return view(
            'professor.class_groups.classroom_group.streams.index',
            compact('classGroup')
        );
    }


    /**
     * Show edit form for a class group.
     */
    public function edit(ClassGroup $classGroup)
    {
        /*
        |--------------------------------------------------------------------------
        | Authorize classroom update
        |--------------------------------------------------------------------------
        */

        Gate::authorize('update', $classGroup);

        $classGroup->load('course');

        return view(
            'professor.class_groups.classroom_group.streams.edit',
            compact('classGroup')
        );
    }


    /**
     * Update a class group.
     */
    public function update(
        Request $request,
        ClassGroup $classGroup
    ) {
        /*
        |--------------------------------------------------------------------------
        | Authorize classroom update
        |--------------------------------------------------------------------------
        */

        Gate::authorize('update', $classGroup);

        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $classGroup->update($validated);

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Class updated successfully.'
            );
    }
}