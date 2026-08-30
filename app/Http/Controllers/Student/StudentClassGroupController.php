<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassGroupController extends Controller
{
    /**
     * Show all class groups the student has joined.
     */
    public function index()
    {
        /** @var User $student */
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Classes the student is enrolled in
        |--------------------------------------------------------------------------
        */

        $classGroups = $student->classGroups()
            ->with([
                'course',
                'professor',
            ])
            ->latest('class_groups.created_at')
            ->get();

        return view(
            'student.class_groups.lists.index',
            compact('classGroups')
        );
    }


    /**
     * Display the student's classroom.
     */
    public function show(ClassGroup $classGroup)
    {
        $student = Auth::user();

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        $classGroup->load([
            'announcements' => function ($query) {
                $query->latest();
            },

            'materials' => function ($query) {
                $query->latest();
            },

            'assignments' => function ($query) {
                $query->latest();
            },
        ]);

        return view(
            'student.class_groups.classroom_group.index',
            compact('classGroup')
        );
    }


    /**
     * Show the join class form.
     */
    public function create()
    {
        return view('student.class_groups.join');
    }


    /**
     * Join a class using the class code.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_code' => [
                'required',
                'string',
                'max:20',
            ],
        ]);

        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Find class by code
        |--------------------------------------------------------------------------
        */

        $classGroup = ClassGroup::where(
            'group_code',
            strtoupper(trim($validated['group_code']))
        )->first();

        if (!$classGroup) {

            return back()
                ->withInput()
                ->withErrors([
                    'group_code' =>
                        'Class code not found. Please check the code and try again.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check class status
        |--------------------------------------------------------------------------
        */

        if ($classGroup->status !== 'active') {

            return back()
                ->withInput()
                ->withErrors([
                    'group_code' =>
                        'This class is no longer available to join.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check if already joined
        |--------------------------------------------------------------------------
        */

        $alreadyJoined = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if ($alreadyJoined) {

            return back()
                ->withErrors([
                    'group_code' =>
                        'You are already enrolled in this class.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Add student to class
        |--------------------------------------------------------------------------
        */

        $classGroup->students()->attach($student->id);


        /*
        |--------------------------------------------------------------------------
        | Redirect to classroom
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.class-groups.classroom',
                $classGroup
            )
            ->with(
                'success',
                'You joined ' . $classGroup->group_name . ' successfully.'
            );
    }
}