<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassGroupController extends Controller
{
    /**
     * ============================================================
     * SHOW ALL CLASS GROUPS
     * ============================================================
     *
     * Show all classes the student has joined.
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
     * ============================================================
     * SHOW CLASSROOM
     * ============================================================
     *
     * Display the student's classroom Stream.
     */
    public function show(ClassGroup $classGroup)
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 1. CHECK STUDENT IS ENROLLED
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }


        /*
        |--------------------------------------------------------------------------
        | 2. LOAD CLASSROOM DATA
        |--------------------------------------------------------------------------
        */

        $classGroup->load([

            /*
            |--------------------------------------------------------------------------
            | CLASS INFORMATION
            |--------------------------------------------------------------------------
            */

            'course',

            'professor',


            /*
            |--------------------------------------------------------------------------
            | ANNOUNCEMENTS
            |--------------------------------------------------------------------------
            */

            'announcements' => function ($query) {
                $query
                    ->with('user')
                    ->latest();
            },


            /*
            |--------------------------------------------------------------------------
            | MATERIALS
            |--------------------------------------------------------------------------
            */

            'materials' => function ($query) {
                $query
                    ->with([
                        'user',
                        'topic',
                    ])
                    ->latest();
            },


            /*
            |--------------------------------------------------------------------------
            | ASSIGNMENTS
            |--------------------------------------------------------------------------
            */

            'assignments' => function ($query) {
                $query
                    ->with([
                        'user',
                        'topic',
                    ])
                    ->latest();
            },


            /*
            |--------------------------------------------------------------------------
            | QUIZZES
            |--------------------------------------------------------------------------
            */

            'quizzes' => function ($query) {
                $query
                    ->with([
                        'user',
                        'topic',
                    ])
                    ->latest();
            },


            /*
            |--------------------------------------------------------------------------
            | EXAMS
            |--------------------------------------------------------------------------
            */

            'exams' => function ($query) {
                $query
                    ->with([
                        'user',
                        'topic',
                    ])
                    ->latest();
            },


            /*
            |--------------------------------------------------------------------------
            | PROJECTS
            |--------------------------------------------------------------------------
            |
            | Individual Project:
            | - Visible to students enrolled in this class.
            |
            | Team Project:
            | - Visible only if the student belongs to one
            |   of the project's teams.
            |
            */

            'projects' => function ($query) use ($student) {

                $query
                    ->where(function ($projectQuery) use ($student) {

                        /*
                        |--------------------------------------------------------------------------
                        | INDIVIDUAL PROJECT
                        |--------------------------------------------------------------------------
                        |
                        | Any student enrolled in the class can see it.
                        |
                        */

                        $projectQuery
                            ->where(
                                'project_type',
                                'individual'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | TEAM PROJECT
                        |--------------------------------------------------------------------------
                        |
                        | Student must be assigned to a team belonging
                        | to this specific project.
                        |
                        */

                        $projectQuery
                            ->orWhere(function ($teamQuery) use ($student) {

                                $teamQuery
                                    ->where(
                                        'project_type',
                                        'team'
                                    )
                                    ->whereHas(
                                        'groups.members',
                                        function ($memberQuery) use ($student) {

                                            $memberQuery->where(
                                                'user_id',
                                                $student->id
                                            );

                                        }
                                    );

                            });

                    })

                    ->with([
                        'user',
                        'topic',
                    ])

                    ->latest();

            },

        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. BUILD STREAM ITEMS
        |--------------------------------------------------------------------------
        |
        | All classroom activities are combined into one collection.
        |
        */

        $streamItems = collect();


        /*
        |--------------------------------------------------------------------------
        | ANNOUNCEMENTS
        |--------------------------------------------------------------------------
        */

        foreach ($classGroup->announcements as $announcement) {

            $streamItems->push([

                'type' => 'announcement',

                'title' => $announcement->title,

                'item' => $announcement,

                'posted_by' =>
                    $announcement->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $announcement->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | MATERIALS
        |--------------------------------------------------------------------------
        */

        foreach ($classGroup->materials as $material) {

            $streamItems->push([

                'type' => 'material',

                'title' => $material->title,

                'item' => $material,

                'posted_by' =>
                    $material->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $material->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS
        |--------------------------------------------------------------------------
        */

        foreach ($classGroup->assignments as $assignment) {

            $streamItems->push([

                'type' => 'assignment',

                'title' => $assignment->title,

                'item' => $assignment,

                'posted_by' =>
                    $assignment->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $assignment->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | QUIZZES
        |--------------------------------------------------------------------------
        */

        foreach ($classGroup->quizzes as $quiz) {

            $streamItems->push([

                'type' => 'quiz',

                'title' => $quiz->title,

                'item' => $quiz,

                'posted_by' =>
                    $quiz->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $quiz->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | EXAMS
        |--------------------------------------------------------------------------
        */

        foreach ($classGroup->exams as $exam) {

            $streamItems->push([

                'type' => 'exam',

                'title' => $exam->title,

                'item' => $exam,

                'posted_by' =>
                    $exam->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $exam->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        |
        | Only projects already filtered for this student are included.
        |
        */

        foreach ($classGroup->projects as $project) {

            $streamItems->push([

                'type' => 'project',

                'title' => $project->title,

                'item' => $project,

                'posted_by' =>
                    $project->user->name
                    ?? $classGroup->professor->name
                    ?? 'Professor',

                'created_at' => $project->created_at,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SORT EVERYTHING BY CREATED DATE
        |--------------------------------------------------------------------------
        */

        $streamItems = $streamItems
            ->sortByDesc('created_at')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | RETURN CLASSROOM
        |--------------------------------------------------------------------------
        */

        return view(
            'student.class_groups.classroom_group.streams.index',
            compact(
                'classGroup',
                'streamItems'
            )
        );
    }


    /**
     * ============================================================
     * SHOW JOIN CLASS FORM
     * ============================================================
     */
    public function create()
    {
        return view(
            'student.class_groups.join'
        );
    }


    /**
     * ============================================================
     * JOIN CLASS
     * ============================================================
     *
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
            strtoupper(
                trim(
                    $validated['group_code']
                )
            )
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

        $classGroup->students()->attach(
            $student->id
        );


        /*
        |--------------------------------------------------------------------------
        | Redirect to classroom
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'You joined ' .
                $classGroup->group_name .
                ' successfully.'
            );
    }
}