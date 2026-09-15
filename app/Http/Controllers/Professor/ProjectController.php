<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\ProjectGroupMember;
use App\Models\Quiz;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * ============================================================
     * CREATE PROJECT
     * ============================================================
     */
    public function create(int $classGroupId)
    {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        return view(
            'professor.class_groups.classroom_group.classworks.projects.create',
            compact('classGroup')
        );
    }


    /**
     * ============================================================
     * GENERATE GROUPS PREVIEW
     * ============================================================
     *
     * This does NOT save anything to the database.
     *
     * It receives:
     * - grouping_method
     * - group_count
     *
     * and returns the generated students/groups as JSON.
     *
     * Methods:
     * - manual
     * - random
     * - balanced
     */
public function generateGroups(
    Request $request,
    int $classGroupId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | VALIDATE GROUPING SETTINGS
    |--------------------------------------------------------------------------
    */

    $validated = $request->validate([
        'grouping_method' => [
            'required',
            'in:manual,random,balanced',
        ],

        'group_count' => [
            'required',
            'integer',
            'min:2',
            'max:10',
        ],
    ]);

    $groupingMethod = $validated['grouping_method'];
    $groupCount = (int) $validated['group_count'];


    /*
    |--------------------------------------------------------------------------
    | GET ENROLLED STUDENTS
    |--------------------------------------------------------------------------
    */

    $students = $classGroup->students()
        ->orderBy('users.name')
        ->get();

    if ($students->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'There are no students enrolled in this classroom.',
        ], 422);
    }


    /*
    |--------------------------------------------------------------------------
    | PERFORMANCE DATA
    |--------------------------------------------------------------------------
    |
    | Used by BALANCED grouping.
    | Performance is based only on this class.
    |
    */

    $studentPerformance = collect();

    if ($groupingMethod === 'balanced') {
        $studentPerformance = $this->calculateStudentPerformance(
            $classGroup,
            $students
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE EMPTY GROUPS
    |--------------------------------------------------------------------------
    */

    $groups = collect();

    for ($i = 1; $i <= $groupCount; $i++) {

        $groups->push([
            'group_number' => $i,
            'group_name' => 'Team ' . $i,
            'members' => collect(),
            'average' => null,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PREPARE STUDENT ORDER
    |--------------------------------------------------------------------------
    */

    $orderedStudents = $students->values();


    /*
    |--------------------------------------------------------------------------
    | RANDOM GROUPING
    |--------------------------------------------------------------------------
    */

    if ($groupingMethod === 'random') {

        $orderedStudents = $students
            ->shuffle()
            ->values();
    }


    /*
    |--------------------------------------------------------------------------
    | BALANCED GROUPING
    |--------------------------------------------------------------------------
    |
    | Highest-performing students first.
    | Students without performance data go to the end.
    |
    */

    if ($groupingMethod === 'balanced') {

        $orderedStudents = $students
            ->sortByDesc(function ($student) use (
                $studentPerformance
            ) {
                return $studentPerformance->get(
                    $student->id
                ) ?? -1;
            })
            ->values();
    }


    /*
    |--------------------------------------------------------------------------
    | DISTRIBUTE STUDENTS
    |--------------------------------------------------------------------------
    |
    | Snake distribution:
    |
    | Team 1 → Team 2 → Team 3
    | Team 6 ← Team 5 ← Team 4
    | Team 7 → Team 8 → Team 9
    |
    */

    $direction = 1;
    $groupIndex = 0;

    foreach ($orderedStudents as $student) {

        /*
        |--------------------------------------------------------------------------
        | GET THE CURRENT GROUP
        |--------------------------------------------------------------------------
        */

        $group = $groups->get($groupIndex);


        /*
        |--------------------------------------------------------------------------
        | ADD STUDENT TO CURRENT GROUP
        |--------------------------------------------------------------------------
        */

        $members = $group['members'];

        $members->push($student);

        $group['members'] = $members;


        /*
        |--------------------------------------------------------------------------
        | PUT THE COMPLETE GROUP BACK
        |--------------------------------------------------------------------------
        |
        | This avoids:
        |
        | $groups[$groupIndex]['members']
        |
        | which causes the Collection error.
        |
        */

        $groups->put(
            $groupIndex,
            $group
        );


        /*
        |--------------------------------------------------------------------------
        | MOVE TO NEXT GROUP
        |--------------------------------------------------------------------------
        */

        if ($groupCount === 1) {
            continue;
        }

        if ($direction === 1) {

            if ($groupIndex === $groupCount - 1) {

                $direction = -1;

            } else {

                $groupIndex++;
            }

        } else {

            if ($groupIndex === 0) {

                $direction = 1;

            } else {

                $groupIndex--;
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CALCULATE GROUP AVERAGES
    |--------------------------------------------------------------------------
    */

    foreach ($groups as $index => $group) {

        if ($groupingMethod !== 'balanced') {
            $group['average'] = null;
            $groups->put($index, $group);
            continue;
        }

        $performanceValues = $group['members']
            ->map(function ($student) use (
                $studentPerformance
            ) {

                return $studentPerformance->get(
                    $student->id
                );
            })
            ->filter(
                fn ($value) =>
                !is_null($value)
            );

        $group['average'] = $performanceValues->isNotEmpty()
            ? round(
                $performanceValues->average(),
                2
            )
            : null;

        $groups->put(
            $index,
            $group
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PREPARE JSON DATA
    |--------------------------------------------------------------------------
    */

    $responseGroups = $groups
        ->map(function ($group) use (
            $studentPerformance,
            $groupingMethod
        ) {

            /*
            |--------------------------------------------------------------------------
            | PREPARE MEMBERS
            |--------------------------------------------------------------------------
            */

            $members = $group['members']
                ->values()
                ->map(function ($student, $index) use (
                    $studentPerformance
                ) {

                    $performance = $studentPerformance->get(
                        $student->id
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | DEFAULT ROLE
                    |--------------------------------------------------------------------------
                    */

                    $role = 'member';

                    if ($index === 0) {

                        $role = 'leader';

                    } elseif ($index === 1) {

                        $role = 'backup';
                    }


                    return [
                        'user_id' => $student->id,

                        'name' => $student->name,

                        'profile_image' =>
                            $student->profile_image ?? null,

                        'performance' => $performance,

                        'role' => $role,
                    ];
                })
                ->values();


            /*
            |--------------------------------------------------------------------------
            | BALANCED ROLE ASSIGNMENT
            |--------------------------------------------------------------------------
            |
            | Highest-performing student becomes leader.
            | Second highest becomes backup.
            |
            */

            if ($groupingMethod === 'balanced') {

                $members = $members
                    ->sortByDesc(function ($member) {

                        return $member['performance'] ?? -1;
                    })
                    ->values();


                $members = $members
                    ->map(function ($member, $index) {

                        if ($index === 0) {

                            $member['role'] = 'leader';

                        } elseif ($index === 1) {

                            $member['role'] = 'backup';

                        } else {

                            $member['role'] = 'member';
                        }

                        return $member;
                    })
                    ->values();
            }


            /*
            |--------------------------------------------------------------------------
            | RETURN GROUP
            |--------------------------------------------------------------------------
            */

            return [
                'group_number' =>
                    $group['group_number'],

                'group_name' =>
                    $group['group_name'],

                'average' =>
                    $group['average'],

                'members' =>
                    $members,
            ];
        })
        ->values();


    /*
    |--------------------------------------------------------------------------
    | RETURN JSON
    |--------------------------------------------------------------------------
    */

    return response()->json([
        'success' => true,

        'method' => $groupingMethod,

        'group_count' => $groupCount,

        'student_count' => $students->count(),

        'groups' => $responseGroups,
    ]);
}


    /**
     * ============================================================
     * CALCULATE STUDENT PERFORMANCE
     * ============================================================
     *
     * Uses:
     * - Assignments
     * - Quizzes
     * - Exams
     *
     * A student with no graded work gets NULL.
     *
     * NULL is NOT treated as zero.
     */
    private function calculateStudentPerformance(
        ClassGroup $classGroup,
        $students
    ) {
        /*
        |--------------------------------------------------------------------------
        | GET ASSIGNMENTS
        |--------------------------------------------------------------------------
        */

        $assignments = Assignment::where(
            'class_group_id',
            $classGroup->id
        )
            ->with('submissions')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GET QUIZZES
        |--------------------------------------------------------------------------
        */

        $quizzes = Quiz::where(
            'class_group_id',
            $classGroup->id
        )
            ->with('submissions')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GET EXAMS
        |--------------------------------------------------------------------------
        */

        $exams = Exam::where(
            'class_group_id',
            $classGroup->id
        )
            ->with('submissions')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CALCULATE
        |--------------------------------------------------------------------------
        */

        $studentPerformance = collect();


        foreach ($students as $student) {

            $percentages = collect();


            /*
            |--------------------------------------------------------------------------
            | ASSIGNMENTS
            |--------------------------------------------------------------------------
            */

            foreach ($assignments as $assignment) {

                $submission = $assignment->submissions
                    ->firstWhere(
                        'student_id',
                        $student->id
                    );


                if (
                    $submission &&
                    !is_null($submission->score) &&
                    $assignment->points > 0
                ) {

                    $percentage =
                        (
                            $submission->score /
                            $assignment->points
                        ) * 100;


                    $percentages->push(
                        $percentage
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | QUIZZES
            |--------------------------------------------------------------------------
            */

            foreach ($quizzes as $quiz) {

                $submission = $quiz->submissions
                    ->firstWhere(
                        'student_id',
                        $student->id
                    );


                if (
                    $submission &&
                    !is_null($submission->score) &&
                    $quiz->points > 0
                ) {

                    $percentage =
                        (
                            $submission->score /
                            $quiz->points
                        ) * 100;


                    $percentages->push(
                        $percentage
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | EXAMS
            |--------------------------------------------------------------------------
            */

            foreach ($exams as $exam) {

                $submission = $exam->submissions
                    ->firstWhere(
                        'student_id',
                        $student->id
                    );


                if (
                    $submission &&
                    !is_null($submission->score) &&
                    $exam->points > 0
                ) {

                    $percentage =
                        (
                            $submission->score /
                            $exam->points
                        ) * 100;


                    $percentages->push(
                        $percentage
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | FINAL PERFORMANCE
            |--------------------------------------------------------------------------
            */

            $average = $percentages->isNotEmpty()
                ? round(
                    $percentages->average(),
                    2
                )
                : null;


            $studentPerformance->put(
                $student->id,
                $average
            );
        }


        return $studentPerformance;
    }


    /**
     * ============================================================
     * STORE PROJECT
     * ============================================================
     *
     * Creates:
     * 1. Project
     * 2. Project resources
     * 3. Project groups
     * 4. Project group members
     */
    public function store(
        Request $request,
        int $classGroupId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);


        /*
        |--------------------------------------------------------------------------
        | VALIDATE PROJECT
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'topic_id' => [
                'nullable',
                'integer',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'due_date' => [
                'required',
                'date',
            ],

            'due_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'points' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'project_type' => [
                'required',
                'in:individual,team',
            ],

            /*
            |--------------------------------------------------------------------------
            | TEAM GROUPS
            |--------------------------------------------------------------------------
            */

            'groups' => [
                'nullable',
                'array',
                'min:2',
                'required_if:project_type,team',
            ],

            'groups.*.group_number' => [
                'required_if:project_type,team',
                'integer',
                'min:1',
            ],

            'groups.*.group_name' => [
                'required_if:project_type,team',
                'string',
                'max:255',
            ],

            'groups.*.members' => [
                'required_if:project_type,team',
                'array',
                'min:1',
            ],

            'groups.*.members.*.user_id' => [
                'required_if:project_type,team',
                'integer',
                'exists:users,id',
            ],

            'groups.*.members.*.role' => [
                'required_if:project_type,team',
                'string',
                'in:leader,backup,member',
            ],

            /*
            |--------------------------------------------------------------------------
            | MULTIPLE PROJECT FILES
            |--------------------------------------------------------------------------
            */

            'attachments' => [
                'nullable',
                'array',
            ],

            'attachments.*' => [
                'file',
                'max:102400',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | VERIFY TOPIC
        |--------------------------------------------------------------------------
        */

        $topic = null;

        if (!empty($validated['topic_id'])) {

            $topic = $classGroup->topics()
                ->where(
                    'id',
                    $validated['topic_id']
                )
                ->firstOrFail();
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATE GROUP MEMBERS BEFORE CREATING PROJECT
        |--------------------------------------------------------------------------
        */

        if (
            $validated['project_type'] === 'team'
        ) {

            $this->validateProjectGroups(
                $classGroup,
                $validated['groups']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE PROJECT
        |--------------------------------------------------------------------------
        */

        $project = Project::create([

            'class_group_id' =>
                $classGroup->id,

            'topic_id' =>
                $topic?->id,

            'user_id' =>
                Auth::id(),

            'title' =>
                $validated['title'],

            'description' =>
                $validated['description'] ?? null,

            'due_date' =>
                $validated['due_date'],

            'due_time' =>
                $validated['due_time'] ?? null,

            'points' =>
                $validated['points'] ?? 100,

            'project_type' =>
                $validated['project_type'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD PROJECT RESOURCES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach (
                $request->file('attachments')
                as $file
            ) {

                $path = $file->store(
                    'projects',
                    'public'
                );


                $project->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' =>
                        'file',

                    'file_path' =>
                        $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' =>
                        null,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE TEAM GROUPS
        |--------------------------------------------------------------------------
        */

        if (
            $validated['project_type'] === 'team'
        ) {

            $this->saveProjectGroups(
                $project,
                $validated['groups']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO CLASSWORK
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with(
                'success',
                'Project created successfully.'
            );
    }


    /**
     * ============================================================
     * VALIDATE PROJECT GROUPS
     * ============================================================
     */
    private function validateProjectGroups(
        ClassGroup $classGroup,
        array $groups
    ) {
        /*
        |--------------------------------------------------------------------------
        | GET ENROLLED STUDENTS
        |--------------------------------------------------------------------------
        */

        $studentIds = $classGroup->students()
            ->pluck('users.id')
            ->map(
                fn ($id) => (int) $id
            )
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | TRACK STUDENTS
        |--------------------------------------------------------------------------
        */

        $assignedStudentIds = [];

        $leaderCount = [];

        $backupCount = [];


        /*
        |--------------------------------------------------------------------------
        | CHECK EVERY GROUP
        |--------------------------------------------------------------------------
        */

        foreach ($groups as $group) {

            $groupNumber =
                (int) $group['group_number'];


            if (
                isset(
                    $leaderCount[$groupNumber]
                )
            ) {
                // nothing
            } else {
                $leaderCount[$groupNumber] = 0;
            }


            if (
                isset(
                    $backupCount[$groupNumber]
                )
            ) {
                // nothing
            } else {
                $backupCount[$groupNumber] = 0;
            }


            foreach (
                $group['members']
                as $member
            ) {

                $userId =
                    (int) $member['user_id'];


                /*
                |--------------------------------------------------------------------------
                | STUDENT MUST BELONG TO CLASS
                |--------------------------------------------------------------------------
                */

                if (
                    !in_array(
                        $userId,
                        $studentIds,
                        true
                    )
                ) {

                    abort(
                        422,
                        'One of the selected students is not enrolled in this classroom.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | STUDENT CAN ONLY BE IN ONE TEAM
                |--------------------------------------------------------------------------
                */

                if (
                    in_array(
                        $userId,
                        $assignedStudentIds,
                        true
                    )
                ) {

                    abort(
                        422,
                        'A student cannot belong to more than one team.'
                    );
                }


                $assignedStudentIds[] =
                    $userId;


                /*
                |--------------------------------------------------------------------------
                | COUNT LEADERS
                |--------------------------------------------------------------------------
                */

                if (
                    $member['role'] === 'leader'
                ) {

                    $leaderCount[$groupNumber]++;
                }


                /*
                |--------------------------------------------------------------------------
                | COUNT BACKUPS
                |--------------------------------------------------------------------------
                */

                if (
                    $member['role'] === 'backup'
                ) {

                    $backupCount[$groupNumber]++;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | EVERY TEAM MUST HAVE EXACTLY ONE LEADER
        |--------------------------------------------------------------------------
        */

        foreach ($groups as $group) {

            $groupNumber =
                (int) $group['group_number'];


            if (
                ($leaderCount[$groupNumber] ?? 0)
                !== 1
            ) {

                abort(
                    422,
                    "Team {$groupNumber} must have exactly one team leader."
                );
            }


            /*
            |--------------------------------------------------------------------------
            | BACKUP IS OPTIONAL
            |--------------------------------------------------------------------------
            |
            | We allow zero or one backup.
            |
            */

            if (
                ($backupCount[$groupNumber] ?? 0)
                > 1
            ) {

                abort(
                    422,
                    "Team {$groupNumber} can have only one backup submitter."
                );
            }
        }
    }


    /**
     * ============================================================
     * SAVE PROJECT GROUPS
     * ============================================================
     */
    private function saveProjectGroups(
        Project $project,
        array $groups
    ) {
        DB::transaction(
            function () use (
                $project,
                $groups
            ) {

                foreach (
                    $groups as $groupData
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | CREATE GROUP
                    |--------------------------------------------------------------------------
                    */

                    $group =
                        ProjectGroup::create([

                            'project_id' =>
                                $project->id,

                            'group_name' =>
                                $groupData['group_name'],

                            'group_number' =>
                                $groupData['group_number'],
                        ]);


                    /*
                    |--------------------------------------------------------------------------
                    | CREATE MEMBERS
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $groupData['members']
                        as $memberData
                    ) {

                        ProjectGroupMember::create([

                            'project_group_id' =>
                                $group->id,

                            'project_id' =>
                                $project->id,

                            'user_id' =>
                                (int) $memberData['user_id'],

                            'role' =>
                                $memberData['role'],
                        ]);
                    }
                }
            }
        );
    }


    /**
     * ============================================================
     * SHOW PROJECT
     * ============================================================
     */
    public function show(
        Request $request,
        int $classGroupId,
        int $projectId
    ) {
        $classGroup = ClassGroup::with('students')
            ->findOrFail($classGroupId);

        Gate::authorize(
            'manage',
            $classGroup
        );

$project = Project::with([
    'user',
    'topic',
    'resources',
    'groups.members.user',

    // Load student/team submissions
    'submissions' => function ($query) {
        $query->whereNotNull('submitted_at')
            ->with([
                'student',
                'projectGroup',
                'resources',
                'grades',
            ])
            ->latest('submitted_at');
    },
])
    ->where(
        'id',
        $projectId
    )
    ->where(
        'class_group_id',
        $classGroup->id
    )
    ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | REMEMBER WHERE USER CAME FROM
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->query(
            'return_to',
            'stream'
        );


        return view(
            'professor.class_groups.classroom_group.classworks.projects.show',
            compact(
                'classGroup',
                'project',
                'returnTo'
            )
        );
    }


    /**
     * ============================================================
     * SHOW ONE PROJECT GROUP
     * ============================================================
     */
    public function showGroup(
        int $classGroupId,
        int $projectId,
        int $groupId
    ) {
        $classGroup = ClassGroup::findOrFail(
            $classGroupId
        );

        Gate::authorize(
            'manage',
            $classGroup
        );


        /*
        |--------------------------------------------------------------------------
        | FIND PROJECT
        |--------------------------------------------------------------------------
        */

        $project = Project::where(
            'id',
            $projectId
        )
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | ONLY TEAM PROJECTS
        |--------------------------------------------------------------------------
        */

        if (
            $project->project_type !== 'team'
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | FIND GROUP
        |--------------------------------------------------------------------------
        */

        $group = $project->groups()
            ->with([
                'members.user',
            ])
            ->where(
                'id',
                $groupId
            )
            ->firstOrFail();


        return view(
            'professor.class_groups.classroom_group.classworks.projects.groups.show',
            compact(
                'classGroup',
                'project',
                'group'
            )
        );
    }


    /**
     * ============================================================
     * EDIT PROJECT
     * ============================================================
     */
    public function edit(
        Request $request,
        int $classGroupId,
        int $projectId
    ) {
        $classGroup = ClassGroup::findOrFail(
            $classGroupId
        );

        Gate::authorize(
            'manage',
            $classGroup
        );


        $project = Project::with('resources')
            ->where(
                'id',
                $projectId
            )
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DETERMINE WHERE USER CAME FROM
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->query(
            'return_to',
            'stream'
        );


        $origin = $request->query(
            'origin',
            'stream'
        );


        return view(
            'professor.class_groups.classroom_group.classworks.projects.edit',
            compact(
                'classGroup',
                'project',
                'returnTo',
                'origin'
            )
        );
    }


    /**
     * ============================================================
     * UPDATE PROJECT
     * ============================================================
     */
    public function update(
        Request $request,
        int $classGroupId,
        int $projectId
    ) {
        $classGroup = ClassGroup::findOrFail(
            $classGroupId
        );

        Gate::authorize(
            'manage',
            $classGroup
        );


        $project = Project::with('resources')
            ->where(
                'id',
                $projectId
            )
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATE REQUEST
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'topic_id' => [
                'nullable',
                'integer',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'due_date' => [
                'required',
                'date',
            ],

            'due_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'points' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'project_type' => [
                'required',
                'in:individual,team',
            ],

            /*
            |--------------------------------------------------------------------------
            | EXISTING RESOURCES
            |--------------------------------------------------------------------------
            */

            'remove_resources' => [
                'nullable',
                'array',
            ],

            'remove_resources.*' => [
                'integer',
            ],

            /*
            |--------------------------------------------------------------------------
            | NEW PROJECT FILES
            |--------------------------------------------------------------------------
            */

            'attachments' => [
                'nullable',
                'array',
            ],

            'attachments.*' => [
                'file',
                'max:102400',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | VERIFY TOPIC
        |--------------------------------------------------------------------------
        */

        $topic = null;

        if (!empty($validated['topic_id'])) {

            $topic = $classGroup->topics()
                ->where(
                    'id',
                    $validated['topic_id']
                )
                ->firstOrFail();
        }


        /*
        |--------------------------------------------------------------------------
        | REMOVE SELECTED EXISTING RESOURCES
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['remove_resources']
            )
        ) {

            $resources = $project->resources()
                ->whereIn(
                    'id',
                    $validated['remove_resources']
                )
                ->get();


            foreach ($resources as $resource) {

                /*
                |--------------------------------------------------------------------------
                | DELETE PHYSICAL FILE
                |--------------------------------------------------------------------------
                */

                if (
                    $resource->file_path &&
                    Storage::disk('public')->exists(
                        $resource->file_path
                    )
                ) {

                    Storage::disk('public')->delete(
                        $resource->file_path
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | DELETE DATABASE RECORD
                |--------------------------------------------------------------------------
                */

                $resource->delete();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ADD NEW RESOURCES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach (
                $request->file('attachments')
                as $file
            ) {

                $path = $file->store(
                    'projects',
                    'public'
                );


                $project->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' =>
                        'file',

                    'file_path' =>
                        $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' =>
                        null,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROJECT INFORMATION
        |--------------------------------------------------------------------------
        */

        $project->topic_id =
            $topic?->id;


        $project->title =
            $validated['title'];


        $project->description =
            $validated['description']
            ?? null;


        $project->due_date =
            $validated['due_date'];


        $project->due_time =
            $validated['due_time']
            ?? null;


        $project->points =
            $validated['points']
            ?? 100;


        $project->project_type =
            $validated['project_type'];


        $project->save();


        /*
        |--------------------------------------------------------------------------
        | RETURN TO CORRECT PAGE
        |--------------------------------------------------------------------------
        */

        /*
/*
|--------------------------------------------------------------------------
| EDIT OPENED FROM PROJECT SHOW
|--------------------------------------------------------------------------
*/
if (
    $request->input('return_to')
    === 'show'
) {
    return redirect()
        ->route(
            'professor.classworks.projects.show',
            [
                'classGroupId' =>
                    $classGroup->id,

                'projectId' =>
                    $project->id,

                'return_to' =>
                    $request->input(
                        'origin',
                        'stream'
                    ),
            ]
        )
        ->with(
            'success',
            'Project updated successfully.'
        );
}


        /*
        |--------------------------------------------------------------------------
        | EDIT OPENED FROM MARKS
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('return_to')
            === 'marks'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Project updated successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | EDIT OPENED FROM CLASSWORK
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('return_to')
            === 'classwork'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Project updated successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT: STREAM
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Project updated successfully.'
            );
    }


    /**
     * ============================================================
     * DELETE PROJECT RESOURCE
     * ============================================================
     */
    public function destroyResource(
        ClassGroup $classGroup,
        Project $project,
        Resource $resource
    ) {
        Gate::authorize(
            'manage',
            $classGroup
        );


        /*
        |--------------------------------------------------------------------------
        | MAKE SURE PROJECT BELONGS TO CLASS GROUP
        |--------------------------------------------------------------------------
        */

        if (
            $project->class_group_id
            !== $classGroup->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | MAKE SURE RESOURCE BELONGS TO PROJECT
        |--------------------------------------------------------------------------
        */

        $resource = $project->resources()
            ->whereKey(
                $resource->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DELETE PHYSICAL FILE
        |--------------------------------------------------------------------------
        */

        if (
            $resource->file_path &&
            Storage::disk('public')->exists(
                $resource->file_path
            )
        ) {

            Storage::disk('public')->delete(
                $resource->file_path
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE RESOURCE RECORD
        |--------------------------------------------------------------------------
        */

        $resource->delete();


        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }


    /**
     * ============================================================
     * DELETE PROJECT
     * ============================================================
     */
    public function destroy(
        Request $request,
        int $classGroupId,
        int $projectId
    ) {
        $classGroup = ClassGroup::findOrFail(
            $classGroupId
        );


        Gate::authorize(
            'manage',
            $classGroup
        );


        $project = Project::with('resources')
            ->where(
                'id',
                $projectId
            )
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | REMEMBER WHERE USER CAME FROM
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->input(
            'return_to',
            'stream'
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE PROJECT RESOURCES
        |--------------------------------------------------------------------------
        */

        foreach (
            $project->resources
            as $resource
        ) {

            if (
                $resource->file_path &&
                Storage::disk('public')->exists(
                    $resource->file_path
                )
            ) {

                Storage::disk('public')->delete(
                    $resource->file_path
                );
            }


            $resource->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PROJECT
        |--------------------------------------------------------------------------
        */

        $project->delete();


        /*
        |--------------------------------------------------------------------------
        | RETURN TO CLASSWORK
        |--------------------------------------------------------------------------
        */

        if (
            $returnTo === 'classwork'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Project deleted successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN TO MARKS
        |--------------------------------------------------------------------------
        */

        if (
            $returnTo === 'marks'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Project deleted successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN TO STREAM
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Project deleted successfully.'
            );
    }

/**
 * ============================================================
 * MANAGE PROJECT GROUPS
 * ============================================================
 */
public function manageGroups(
    int $classGroupId,
    int $projectId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::with([
        'groups.members.user',
    ])
        ->where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | Get all students enrolled in this class
    |--------------------------------------------------------------------------
    */
    $students = $classGroup->students()
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Get students already assigned to a team in this project
    |--------------------------------------------------------------------------
    */
    $assignedStudentIds = $project->groups
        ->flatMap(function ($group) {
            return $group->members->pluck('user_id');
        })
        ->unique();

    /*
    |--------------------------------------------------------------------------
    | Students who are not assigned to any project team
    |--------------------------------------------------------------------------
    */
    $unassignedStudents = $students
        ->whereNotIn('id', $assignedStudentIds);

    return view(
        'professor.class_groups.classroom_group.classworks.projects.groups.manage',
        compact(
            'classGroup',
            'project',
            'students',
            'unassignedStudents'
        )
    );
}

/**
 * ============================================================
 * ADD STUDENT TO PROJECT TEAM
 * ============================================================
 */
public function addStudentToGroup(
    Request $request,
    int $classGroupId,
    int $projectId,
    int $groupId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $group = ProjectGroup::where('id', $groupId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    $validated = $request->validate([
        'user_id' => [
            'required',
            'integer',
        ],

        'role' => [
            'required',
            'in:member,leader,backup',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Make sure student belongs to this class
    |--------------------------------------------------------------------------
    */
    $studentBelongsToClass = $classGroup->students()
        ->where('users.id', $validated['user_id'])
        ->exists();

    if (!$studentBelongsToClass) {
        return back()->withErrors([
            'user_id' => 'This student is not enrolled in this class.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Make sure student is not already assigned to this project
    |--------------------------------------------------------------------------
    */
    $alreadyAssigned = ProjectGroupMember::where(
        'project_id',
        $project->id
    )
        ->where(
            'user_id',
            $validated['user_id']
        )
        ->exists();

    if ($alreadyAssigned) {
        return back()->withErrors([
            'user_id' => 'This student is already assigned to a team.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Only one leader / backup per team
    |--------------------------------------------------------------------------
    */
    if (
        in_array(
            $validated['role'],
            ['leader', 'backup']
        )
    ) {
        ProjectGroupMember::where(
            'project_group_id',
            $group->id
        )
            ->where(
                'role',
                $validated['role']
            )
            ->update([
                'role' => 'member',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Add student
    |--------------------------------------------------------------------------
    */
    ProjectGroupMember::create([
        'project_group_id' => $group->id,
        'project_id' => $project->id,
        'user_id' => $validated['user_id'],
        'role' => $validated['role'],
    ]);

    return back()->with(
        'success',
        'Student added to the team successfully.'
    );
}

/**
 * ============================================================
 * REMOVE STUDENT FROM PROJECT TEAM
 * ============================================================
 */
public function removeStudentFromGroup(
    int $classGroupId,
    int $projectId,
    int $groupId,
    int $memberId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $member = ProjectGroupMember::where('id', $memberId)
        ->where('project_id', $project->id)
        ->where('project_group_id', $groupId)
        ->firstOrFail();

    $member->delete();

    return back()->with(
        'success',
        'Student removed from the team.'
    );
}

/**
 * ============================================================
 * UPDATE PROJECT TEAM MEMBER ROLE
 * ============================================================
 */
public function updateMemberRole(
    Request $request,
    int $classGroupId,
    int $projectId,
    int $groupId,
    int $memberId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $member = ProjectGroupMember::where('id', $memberId)
        ->where('project_id', $project->id)
        ->where('project_group_id', $groupId)
        ->firstOrFail();

    $validated = $request->validate([
        'role' => [
            'required',
            'in:member,leader,backup',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Only one leader / backup per team
    |--------------------------------------------------------------------------
    */
    if (
        in_array(
            $validated['role'],
            ['leader', 'backup']
        )
    ) {
        ProjectGroupMember::where(
            'project_group_id',
            $groupId
        )
            ->where(
                'id',
                '!=',
                $member->id
            )
            ->where(
                'role',
                $validated['role']
            )
            ->update([
                'role' => 'member',
            ]);
    }

    $member->update([
        'role' => $validated['role'],
    ]);

    return back()->with(
        'success',
        'Student role updated successfully.'
    );
}

/**
 * ============================================================
 * MOVE STUDENT TO ANOTHER PROJECT TEAM
 * ============================================================
 */
public function moveStudentToGroup(
    Request $request,
    int $classGroupId,
    int $projectId,
    int $groupId,
    int $memberId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    // Source team: the team from which the professor clicked Move.
    $sourceGroup = ProjectGroup::where('id', $groupId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    // IMPORTANT: identify the exact student membership.
    $member = ProjectGroupMember::with('user')
        ->where('id', $memberId)
        ->where('project_id', $project->id)
        ->where('project_group_id', $sourceGroup->id)
        ->firstOrFail();

    $validated = $request->validate([
        'project_group_id' => [
            'required',
            'integer',
        ],
    ]);

    // Destination must also belong to this project.
    $targetGroup = ProjectGroup::where(
        'id',
        $validated['project_group_id']
    )
        ->where('project_id', $project->id)
        ->firstOrFail();

    if ($targetGroup->id === $sourceGroup->id) {
        return back()->withErrors([
            'project_group_id' => 'The student is already in this team.',
        ]);
    }

    // Keep the same membership record, user, and role.
    $member->update([
        'project_group_id' => $targetGroup->id,
    ]);

    return back()->with(
        'success',
        ($member->user?->name ?? 'Student')
        . ' was moved to '
        . $targetGroup->group_name
        . '.'
    );
}
/**
 * ============================================================
 * CREATE PROJECT TEAM
 * ============================================================
 */
public function createGroup(
    Request $request,
    int $classGroupId,
    int $projectId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $validated = $request->validate([
        'group_name' => [
            'required',
            'string',
            'max:255',
        ],
    ]);

    $nextGroupNumber = (
        $project->groups()->max('group_number') ?? 0
    ) + 1;

    ProjectGroup::create([
        'project_id' => $project->id,
        'group_name' => $validated['group_name'],
        'group_number' => $nextGroupNumber,
    ]);

    return back()->with(
        'success',
        'Team created successfully.'
    );
}
/**
 * ============================================================
 * RENAME PROJECT TEAM
 * ============================================================
 */
public function renameGroup(
    Request $request,
    int $classGroupId,
    int $projectId,
    int $groupId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $group = ProjectGroup::where('id', $groupId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    $validated = $request->validate([
        'group_name' => [
            'required',
            'string',
            'max:255',
        ],
    ]);

    $group->update([
        'group_name' => $validated['group_name'],
    ]);

    return back()->with(
        'success',
        'Team renamed successfully.'
    );
}
/**
 * ============================================================
 * DELETE PROJECT TEAM
 * ============================================================
 */
public function deleteGroup(
    int $classGroupId,
    int $projectId,
    int $groupId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    $group = ProjectGroup::withCount('members')
        ->where('id', $groupId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    if ($group->members_count > 0) {
        return back()->withErrors([
            'group' => 'A team can only be deleted when it has no students.',
        ]);
    }

    $group->delete();

    return back()->with(
        'success',
        'Team deleted successfully.'
    );
}
}