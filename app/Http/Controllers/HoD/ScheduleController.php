<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\ScheduleDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\Department;

class ScheduleController extends Controller
{


    // index function

    public function index(Request $request)
    {
        /** @var User $user */
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->with('head', 'college')
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as HoD of a department.');
        }

        /*
        |--------------------------------------------------------------------------
        | BROWSE FILTERS
        |--------------------------------------------------------------------------
        | "all" means no filter is applied.
        */
        $year = $request->input('year', 'all');
        $promotion = $request->input('promotion', 'all');
        $semester = $request->input('semester', 'all');

        $validYears = ['all', '1', '2', '3', '4', 1, 2, 3, 4];
        if (!in_array($year, $validYears, true)) {
            $year = 'all';
        }

        if ($year !== 'all') {
            $year = (string) (int) $year;
        }

        if (!in_array($semester, ['all', 'Semester 1', 'Semester 2'], true)) {
            $semester = 'all';
        }

        /*
        |--------------------------------------------------------------------------
        | PROMOTION FILTER
        |--------------------------------------------------------------------------
        */

        $availablePromotions = Schedule::whereHas('scheduleDepartments', function ($query) use ($department) {
            $query->where('department_id', $department->id);
        })
            ->whereNotNull('promotion')
            ->distinct()
            ->orderBy('promotion')
            ->pluck('promotion');

        if ($promotion !== 'all' && !in_array((int) $promotion, $availablePromotions->map(fn ($value) => (int) $value)->all(), true)) {
            $promotion = 'all';
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD ALL SESSIONS THAT BELONG TO THIS HOD'S DEPARTMENT
        |--------------------------------------------------------------------------
        */
        $query = Schedule::with([
            'course',
            'professor',
            'room',
            'timeSlot',
            'scheduleDepartments',
        ])
            ->whereHas('scheduleDepartments', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            });

        if ($year !== 'all') {
            $query->whereHas('scheduleDepartments', function ($query) use ($department, $year) {
                $query->where('department_id', $department->id)
                    ->where('year_level', (int) $year);
            });
        }

        if ($semester !== 'all') {
            $query->where('semester', $semester);
        }

        if ($promotion !== 'all') {
            $query->where('promotion', (int) $promotion);
        }

        $schedules = $query
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
            ->orderBy('slot_id')
            ->orderByDesc('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | GROUP SESSIONS INTO WEEKLY SCHEDULES
        |--------------------------------------------------------------------------
        */
        $scheduleGroups = $schedules
            ->groupBy(function ($schedule) {
                return $schedule->schedule_group_id
                    ?: 'schedule-' . $schedule->id;
            })
            ->map(function ($group) use ($department) {
                $first = $group->first();

                $yearLevels = $group
                    ->flatMap(function ($schedule) use ($department) {
                        return $schedule->scheduleDepartments
                            ->where('department_id', $department->id)
                            ->pluck('year_level');
                    })
                    ->map(fn ($value) => (int) $value)
                    ->unique()
                    ->sort()
                    ->values();

                $yearLevelLabel = $yearLevels->count() === 1
                    ? 'Year ' . $yearLevels->first()
                    : ($yearLevels->isEmpty()
                        ? 'All Years'
                        : $yearLevels->map(fn ($level) => 'Year ' . $level)->implode(' + '));

                return (object) [
                    'id' => $first->id,
                    'schedule_group_id' => $first->schedule_group_id,
                    'semester' => $first->semester,
                    'academic_year' => $first->academic_year,
                    'promotion' => $first->promotion,
                    'starting_date' => $first->starting_date,
                    'finished_date' => $first->finished_date,
                    'midterm_exam_start' => $first->midterm_exam_start,
                    'midterm_exam_end' => $first->midterm_exam_end,
                    'final_exam_start' => $first->final_exam_start,
                    'final_exam_end' => $first->final_exam_end,
                    'status' => $first->status,
                    'sessions' => $group->values(),
                    'session_count' => $group->count(),
                    'day_count' => $group->pluck('day_of_week')->unique()->count(),
                    'year_level_label' => $yearLevelLabel,
                    'year_levels' => $yearLevels,
                    'latest_created_at' => $group->max('created_at'),
                ];
            })
            ->sortByDesc('latest_created_at')
            ->values();

        $timeSlots = TimeSlot::orderBy('session_number')
            ->take(4)
            ->get();

        $allFilteredSchedules = $schedules;
        $exportSchedule = $allFilteredSchedules->first();

        $scheduledDays = $allFilteredSchedules
            ->pluck('day_of_week')
            ->unique()
            ->values()
            ->toArray();

        $promotions = $availablePromotions;

        return view('hod.schedules.lists.index', compact(
            'schedules',
            'scheduleGroups',
            'department',
            'year',
            'promotion',
            'promotions',
            'semester',
            'timeSlots',
            'exportSchedule',
            'scheduledDays'
        ));
    }

    public function create(Request $request)
    {
        /** @var User $user */
$user = Auth::user();

        $department = $user->departments()->first();

        if (!$department) {
            abort(403, 'You are not assigned to a department.');
        }

        $year = (int) $request->input('year', 1);

        $day = $request->input('day', 'Monday');

        if (!in_array($year, [1, 2, 3, 4])) {
            $year = 1;
        }

        $validDays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ];

        if (!in_array($day, $validDays)) {
            $day = 'Monday';
        }

        $courses = Course::where(
            'department_id',
            $department->id
        )
            ->orderBy('course_name')
            ->get();

        $professors = $department->users()
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Professor');
            })
            ->orderBy('name')
            ->get();

        $classrooms = Classroom::orderBy('room_name')->get();

        $timeSlots = TimeSlot::orderBy('session_number')->get();

        return view('hod.schedules.create', compact(
            'department',
            'courses',
            'professors',
            'classrooms',
            'timeSlots',
            'year',
            'day'
        ));
    }

    public function edit(Request $request, Schedule $schedule)
    {
        /** @var User $user */
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | GET HOD DEPARTMENT
        |--------------------------------------------------------------------------
        */

        $department = $user->departments()
            ->with('head')
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as HoD of a department.');
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $belongsToDepartment = $schedule->scheduleDepartments()
            ->where('department_id', $department->id)
            ->exists();

        if (!$belongsToDepartment) {
            abort(403, 'You are not allowed to edit this schedule.');
        }

        /*
        |--------------------------------------------------------------------------
        | GET MAIN YEAR
        |--------------------------------------------------------------------------
        */

        $year = $schedule->scheduleDepartments()
            ->where('department_id', $department->id)
            ->value('year_level');

        $year = (int) ($year ?? 1);

        /*
        |--------------------------------------------------------------------------
        | LOAD FORM DATA
        |--------------------------------------------------------------------------
        */

        $courses = Course::where(
            'department_id',
            $department->id
        )
            ->orderBy('course_name')
            ->get();

        $professors = $department->users()
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Professor');
            })
            ->orderBy('name')
            ->get();

        $classrooms = Classroom::orderBy('room_name')
            ->get();

        $timeSlots = TimeSlot::orderBy('session_number')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | GET THE SAME FOUR SESSION SLOTS AS CREATE
        |--------------------------------------------------------------------------
        */

        $sessionSlots = $timeSlots
            ->sortBy('session_number')
            ->take(4)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | LOAD THE WHOLE WEEK
        |--------------------------------------------------------------------------
        |
        | Edit must show the saved information for:
        |
        | Monday    → Session 1-4
        | Tuesday   → Session 1-4
        | Wednesday → Session 1-4
        | Thursday  → Session 1-4
        | Friday    → Session 1-4
        |
        | We use the same semester, academic year and promotion as the
        | schedule being edited.
        |
        */

        $weeklySchedules = Schedule::with([
            'course',
            'professor',
            'room',
            'timeSlot',
            'scheduleDepartments',
        ])
            ->whereIn('day_of_week', [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ])
            ->whereIn(
                'slot_id',
                $sessionSlots->pluck('id')
            )
            ->where(
                'semester',
                $schedule->semester
            )
            ->where(
                'academic_year',
                $schedule->academic_year
            )
            ->where(
                'promotion',
                $schedule->promotion
            )
            ->whereHas(
                'scheduleDepartments',
                function ($query) use ($department) {
                    $query->where(
                        'department_id',
                        $department->id
                    );
                }
            )
            ->orderByRaw(
                "FIELD(
                    day_of_week,
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday'
                )"
            )
            ->orderBy('slot_id')
            ->orderByDesc('updated_at')
            ->get()
            ->unique(function ($item) {
                return $item->day_of_week . '-' . $item->slot_id;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SEND TO EDIT PAGE
        |--------------------------------------------------------------------------
        */

        $returnToPreview = $request->boolean('return_to_preview');

        return view(
            'hod.schedules.edit',
            compact(
                'schedule',
                'weeklySchedules',
                'department',
                'courses',
                'professors',
                'classrooms',
                'timeSlots',
                'sessionSlots',
                'year',
                'returnToPreview'
            )
        );
    }


    public function update(Request $request, Schedule $schedule)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'semester' => 'required|in:Semester 1,Semester 2',

            'academic_year' => 'required|string|max:20',

            'promotion' => 'required|integer|min:1|max:100',

            'starting_date' => 'required|date',

            'finished_date' =>
                'required|date|after_or_equal:starting_date',

            'midterm_exam_start' => 'required|date',

            'midterm_exam_end' =>
                'required|date|after_or_equal:midterm_exam_start',

            'final_exam_start' => 'required|date',

            'final_exam_end' =>
                'required|date|after_or_equal:final_exam_start',

            'main_year' =>
                'required|integer|in:1,2,3,4',

            'note' =>
                'nullable|string|max:5000',

            /*
            |--------------------------------------------------------------------------
            | WHOLE WEEK
            |--------------------------------------------------------------------------
            |
            | Each day may contain zero or more enabled sessions.
            | Disabled/empty sessions are simply not submitted by the Blade.
            |
            */

            'days' =>
                'required|array|min:1',

            'days.*' =>
                'array',

            'days.*.*.activity_type' =>
                'nullable|in:course,chapel,break,free,other',

            'days.*.*.special_note' =>
                'nullable|string|max:500',

            'days.*.*.course_id' =>
                'nullable|exists:courses,id',

            'days.*.*.professor_id' =>
                'nullable|exists:users,id',

            'days.*.*.room_id' =>
                'nullable|exists:classrooms,id',

            'days.*.*.slot_id' =>
                'required|exists:time_slots,id',

            'days.*.*.combined_years' =>
                'nullable|array',

            'days.*.*.combined_years.*' =>
                'integer|in:1,2,3,4',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $mainYear = (int) $request->main_year;

        /*
        |--------------------------------------------------------------------------
        | VALID DAYS
        |--------------------------------------------------------------------------
        */

        $validDays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ];

        foreach ($request->days as $day => $dayRows) {
            if (!in_array($day, $validDays, true)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'days' =>
                            'Invalid schedule day selected.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | GET HOD DEPARTMENT
        |--------------------------------------------------------------------------
        */

        $department = $user->departments()
            ->with('head')
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(
                403,
                'You are not assigned as HoD of a department.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $belongsToDepartment = $schedule->scheduleDepartments()
            ->where(
                'department_id',
                $department->id
            )
            ->exists();

        if (!$belongsToDepartment) {
            abort(
                403,
                'You are not allowed to edit this schedule.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD THE EXISTING WEEK
        |--------------------------------------------------------------------------
        |
        | This gives us all schedules that currently belong to the schedule
        | being edited. We use the ORIGINAL values here because the user may
        | change semester, academic year or promotion during the edit.
        |
        */

        $oldSchedules = Schedule::with([
            'scheduleDepartments',
        ])
            ->whereIn(
                'day_of_week',
                $validDays
            )
            ->where(
                'semester',
                $schedule->semester
            )
            ->where(
                'academic_year',
                $schedule->academic_year
            )
            ->where(
                'promotion',
                $schedule->promotion
            )
            ->whereIn(
                'slot_id',
                TimeSlot::orderBy('session_number')
                    ->take(4)
                    ->pluck('id')
            )
            ->whereHas(
                'scheduleDepartments',
                function ($query) use ($department) {
                    $query->where(
                        'department_id',
                        $department->id
                    );
                }
            )
            ->orderByDesc('updated_at')
            ->get()
            ->unique(function ($item) {
                return $item->day_of_week . '-' . $item->slot_id;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | FALLBACK: MAKE SURE ORIGINAL SCHEDULE IS INCLUDED
        |--------------------------------------------------------------------------
        */

        if (
            !$oldSchedules->contains(
                'id',
                $schedule->id
            )
        ) {
            $oldSchedules->push(
                $schedule
            );
        }

        $oldScheduleIds = $oldSchedules
            ->pluck('id')
            ->map(
                fn ($id) => (int) $id
            )
            ->values()
            ->all();

        /*
        |--------------------------------------------------------------------------
        | PREPARE ROWS
        |--------------------------------------------------------------------------
        */

        $preparedRows = [];

        foreach ($request->days as $day => $dayRows) {

            foreach ($dayRows as $index => $row) {

                /*
                |--------------------------------------------------------------------------
                | ACTIVITY TYPE
                |--------------------------------------------------------------------------
                */

                $activityType =
                    $row['activity_type']
                    ?? 'course';

                $specialNote =
                    $row['special_note']
                    ?? null;

                /*
                |--------------------------------------------------------------------------
                | NORMAL COURSE
                |--------------------------------------------------------------------------
                */

                if ($activityType === 'course') {

                    /*
                    |--------------------------------------------------------------------------
                    | COMPLETELY EMPTY SESSION
                    |--------------------------------------------------------------------------
                    |
                    | The Create flow allows an unused time slot.
                    | Do not create anything for it.
                    |
                    */

                    if (
                        empty($row['course_id']) &&
                        empty($row['professor_id']) &&
                        empty($row['room_id'])
                    ) {
                        continue;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | COURSE SESSION MUST BE COMPLETE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        empty($row['course_id']) ||
                        empty($row['professor_id']) ||
                        empty($row['room_id'])
                    ) {
                        return back()
                            ->withInput()
                            ->withErrors([
                                "days.{$day}.{$index}.course_id" =>
                                    'Please complete the course, professor, and classroom for this session.',
                            ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | COURSE MUST BELONG TO HOD DEPARTMENT
                    |--------------------------------------------------------------------------
                    */

                    $course = Course::where(
                        'id',
                        $row['course_id']
                    )
                        ->where(
                            'department_id',
                            $department->id
                        )
                        ->first();

                    if (!$course) {
                        return back()
                            ->withInput()
                            ->withErrors([
                                "days.{$day}.{$index}.course_id" =>
                                    'This course does not belong to your department.',
                            ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | GET YEAR LEVELS
                    |--------------------------------------------------------------------------
                    */

                    $combinedYears = array_map(
                        'intval',
                        $row['combined_years'] ?? []
                    );

                    $yearLevels = array_unique([
                        $mainYear,
                        ...$combinedYears,
                    ]);

                    $preparedRows[] = [
                        'day' => $day,
                        'index' => $index,
                        'activity_type' => 'course',
                        'special_note' => null,
                        'course_id' => $row['course_id'],
                        'professor_id' => $row['professor_id'],
                        'room_id' => $row['room_id'],
                        'slot_id' => $row['slot_id'],
                        'year_levels' => $yearLevels,
                    ];

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | SPECIAL ACTIVITY
                |--------------------------------------------------------------------------
                |
                | Chapel, Break, Free Time and Other do not need a course,
                | professor or classroom.
                |
                */

                $combinedYears = array_map(
                    'intval',
                    $row['combined_years'] ?? []
                );

                $yearLevels = array_unique([
                    $mainYear,
                    ...$combinedYears,
                ]);

                $preparedRows[] = [
                    'day' => $day,
                    'index' => $index,
                    'activity_type' => $activityType,
                    'special_note' => $specialNote,
                    'course_id' => null,
                    'professor_id' => null,
                    'room_id' => null,
                    'slot_id' => $row['slot_id'],
                    'year_levels' => $yearLevels,
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK FOR DUPLICATE SESSION SLOT IN THE SAME DAY
        |--------------------------------------------------------------------------
        */

        $seenSlots = [];

        foreach ($preparedRows as $row) {

            $slotKey =
                $row['day'] . '-' . $row['slot_id'];

            if (isset($seenSlots[$slotKey])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$row['day']}.{$row['index']}.slot_id" =>
                            'This time slot is already used in another session for this day.',
                    ]);
            }

            $seenSlots[$slotKey] = true;
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK CONFLICTS BETWEEN SESSIONS IN THIS EDIT
        |--------------------------------------------------------------------------
        */

        foreach ($preparedRows as $currentIndex => $current) {

            foreach ($preparedRows as $otherIndex => $other) {

                if ($currentIndex >= $otherIndex) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | DIFFERENT DAY
                |--------------------------------------------------------------------------
                */

                if ($current['day'] !== $other['day']) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | DIFFERENT TIME
                |--------------------------------------------------------------------------
                */

                if (
                    (int) $current['slot_id'] !==
                    (int) $other['slot_id']
                ) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | PROFESSOR CONFLICT
                |--------------------------------------------------------------------------
                |
                | Only Course sessions have professors.
                |
                */

                if (
                    !empty($current['professor_id']) &&
                    !empty($other['professor_id']) &&
                    (int) $current['professor_id'] ===
                    (int) $other['professor_id']
                ) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$current['day']}.{$current['index']}.professor_id" =>
                                'This professor is already selected in another session at this time.',
                        ]);
                }

                /*
                |--------------------------------------------------------------------------
                | CLASSROOM CONFLICT
                |--------------------------------------------------------------------------
                */

                if (
                    !empty($current['room_id']) &&
                    !empty($other['room_id']) &&
                    (int) $current['room_id'] ===
                    (int) $other['room_id']
                ) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$current['day']}.{$current['index']}.room_id" =>
                                'This classroom is already selected in another session at this time.',
                        ]);
                }

                /*
                |--------------------------------------------------------------------------
                | YEAR LEVEL CONFLICT
                |--------------------------------------------------------------------------
                |
                | Applies to both courses and special activities.
                |
                */

                $sameYear = array_intersect(
                    $current['year_levels'],
                    $other['year_levels']
                );

                if (!empty($sameYear)) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$current['day']}.{$current['index']}.activity_type" =>
                                'One or more selected year levels are already selected in another session at this time.',
                        ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK DATABASE CONFLICTS
        |--------------------------------------------------------------------------
        |
        | Ignore all sessions currently being edited.
        |
        */

        foreach ($preparedRows as $row) {

            $ignoreIds = $oldScheduleIds;

            /*
            |--------------------------------------------------------------------------
            | PROFESSOR CONFLICT
            |--------------------------------------------------------------------------
            */

            if (
                $row['activity_type'] === 'course' &&
                !empty($row['professor_id'])
            ) {

                $professorConflict = Schedule::where(
                    'professor_id',
                    $row['professor_id']
                )
                    ->where(
                        'day_of_week',
                        $row['day']
                    )
                    ->where(
                        'slot_id',
                        $row['slot_id']
                    )
                    ->where(
                        'semester',
                        $request->semester
                    )
                    ->where(
                        'academic_year',
                        $request->academic_year
                    )
                    ->where(
                        'promotion',
                        $request->promotion
                    )
                    ->whereNotIn(
                        'id',
                        $ignoreIds
                    )
                    ->exists();

                if ($professorConflict) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$row['day']}.{$row['index']}.professor_id" =>
                                'This professor already has a schedule at this time.',
                        ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CLASSROOM CONFLICT
            |--------------------------------------------------------------------------
            */

            if (
                $row['activity_type'] === 'course' &&
                !empty($row['room_id'])
            ) {

                $classroomConflict = Schedule::where(
                    'room_id',
                    $row['room_id']
                )
                    ->where(
                        'day_of_week',
                        $row['day']
                    )
                    ->where(
                        'slot_id',
                        $row['slot_id']
                    )
                    ->where(
                        'semester',
                        $request->semester
                    )
                    ->where(
                        'academic_year',
                        $request->academic_year
                    )
                    ->where(
                        'promotion',
                        $request->promotion
                    )
                    ->whereNotIn(
                        'id',
                        $ignoreIds
                    )
                    ->exists();

                if ($classroomConflict) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$row['day']}.{$row['index']}.room_id" =>
                                'This classroom is already occupied at this time.',
                        ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | YEAR LEVEL CONFLICT
            |--------------------------------------------------------------------------
            */

            $yearConflict = Schedule::where(
                'day_of_week',
                $row['day']
            )
                ->where(
                    'slot_id',
                    $row['slot_id']
                )
                ->where(
                    'semester',
                    $request->semester
                )
                ->where(
                    'academic_year',
                    $request->academic_year
                )
                ->where(
                    'promotion',
                    $request->promotion
                )
                ->whereNotIn(
                    'id',
                    $ignoreIds
                )
                ->whereHas(
                    'scheduleDepartments',
                    function ($query) use (
                        $department,
                        $row
                    ) {
                        $query
                            ->where(
                                'department_id',
                                $department->id
                            )
                            ->whereIn(
                                'year_level',
                                $row['year_levels']
                            );
                    }
                )
                ->exists();

            if ($yearConflict) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$row['day']}.{$row['index']}.activity_type" =>
                            'One or more selected year levels already have a schedule at this time.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE WHOLE WEEK
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $request,
            $schedule,
            $user,
            $department,
            $oldSchedules,
            $oldScheduleIds,
            $preparedRows
        ) {

            /*
            |--------------------------------------------------------------------------
            | KEEP ONE GROUP ID FOR THE WHOLE WEEK
            |--------------------------------------------------------------------------
            |
            | Existing weekly schedules keep their group id.
            | Old records without one receive a new shared group id.
            |
            */

            $scheduleGroupId =
                $schedule->schedule_group_id
                ?: (string) Str::uuid();

            $savedScheduleIds = [];

            /*
            |--------------------------------------------------------------------------
            | SAVE EACH ENABLED SESSION
            |--------------------------------------------------------------------------
            */

            foreach ($preparedRows as $row) {

                /*
                |--------------------------------------------------------------------------
                | FIND EXISTING SESSION
                |--------------------------------------------------------------------------
                */

                $sessionSchedule = $oldSchedules->first(
                    function ($oldSchedule) use ($row) {
                        return $oldSchedule->day_of_week ===
                            $row['day']
                            &&
                            (int) $oldSchedule->slot_id ===
                            (int) $row['slot_id'];
                    }
                );

                /*
                |--------------------------------------------------------------------------
                | PREPARE DATA
                |--------------------------------------------------------------------------
                */

                $scheduleData = [
                    'schedule_group_id' => $scheduleGroupId,

                    'activity_type' => $row['activity_type'],

                    'special_note' =>
                        $row['activity_type'] !== 'course'
                            ? $row['special_note']
                            : null,

                    'course_id' =>
                        $row['activity_type'] === 'course'
                            ? $row['course_id']
                            : null,

                    'professor_id' =>
                        $row['activity_type'] === 'course'
                            ? $row['professor_id']
                            : null,

                    'room_id' =>
                        $row['activity_type'] === 'course'
                            ? $row['room_id']
                            : null,

                    'day_of_week' => $row['day'],

                    'slot_id' => $row['slot_id'],

                    'semester' => $request->semester,

                    'academic_year' =>
                        $request->academic_year,

                    'promotion' =>
                        $request->promotion,

                    'starting_date' =>
                        $request->starting_date,

                    'finished_date' =>
                        $request->finished_date,

                    'midterm_exam_start' =>
                        $request->midterm_exam_start,

                    'midterm_exam_end' =>
                        $request->midterm_exam_end,

                    'final_exam_start' =>
                        $request->final_exam_start,

                    'final_exam_end' =>
                        $request->final_exam_end,

                    'status' => 'draft',

                    'note' =>
                        $request->input('note'),
                ];

                /*
                |--------------------------------------------------------------------------
                | UPDATE OR CREATE
                |--------------------------------------------------------------------------
                */

                if ($sessionSchedule) {

                    $sessionSchedule->update(
                        $scheduleData
                    );

                } else {

                    $scheduleData['created_by'] =
                        $user->id;

                    $scheduleData['approved_by'] =
                        null;

                    $sessionSchedule =
                        Schedule::create(
                            $scheduleData
                        );
                }

                /*
                |--------------------------------------------------------------------------
                | UPDATE DEPARTMENT YEAR LEVELS
                |--------------------------------------------------------------------------
                */

                $sessionSchedule
                    ->scheduleDepartments()
                    ->where(
                        'department_id',
                        $department->id
                    )
                    ->delete();

                foreach (
                    $row['year_levels']
                    as $yearLevel
                ) {

                    ScheduleDepartment::create([
                        'schedule_id' =>
                            $sessionSchedule->id,

                        'department_id' =>
                            $department->id,

                        'year_level' =>
                            $yearLevel,
                    ]);
                }

                $savedScheduleIds[] =
                    (int) $sessionSchedule->id;
            }

            /*
            |--------------------------------------------------------------------------
            | REMOVE DISABLED / DELETED SESSIONS
            |--------------------------------------------------------------------------
            */

            foreach ($oldSchedules as $oldSchedule) {

                if (
                    in_array(
                        (int) $oldSchedule->id,
                        $savedScheduleIds,
                        true
                    )
                ) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Remove only this department's relationship
                |--------------------------------------------------------------------------
                */

                $oldSchedule
                    ->scheduleDepartments()
                    ->where(
                        'department_id',
                        $department->id
                    )
                    ->delete();

                /*
                |--------------------------------------------------------------------------
                | Delete the schedule if no department uses it
                |--------------------------------------------------------------------------
                */

                if (
                    !$oldSchedule
                        ->scheduleDepartments()
                        ->exists()
                ) {
                    $oldSchedule->delete();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | MAKE ORIGINAL SCHEDULE ID CONTINUE TO BE USABLE
            |--------------------------------------------------------------------------
            |
            | If the original schedule was disabled/deleted, another saved
            | session becomes the primary editing record for future edits.
            |
            */

            if (
                !in_array(
                    (int) $schedule->id,
                    $savedScheduleIds,
                    true
                )
            ) {
                /*
                | Nothing else is required here.
                | The redirect will use the main year/day values.
                */
            }
        });

        /*
        |--------------------------------------------------------------------------
        | DONE
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | RETURN TO DOCX PREVIEW WHEN EDIT WAS OPENED FROM PREVIEW
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('return_to_preview')) {
            $previewScheduleId = $savedScheduleIds[0] ?? $schedule->id;

            return redirect()
                ->route('hod.schedules.previewDocx', $previewScheduleId)
                ->with(
                    'success',
                    'Weekly schedule updated successfully.'
                );
        }

        return redirect()
            ->route(
                'hod.schedules.index',
                [
                    'year' => $mainYear,
                    'day' => 'Monday',
                    'semester' => $request->semester,
                    'promotion' => $request->promotion,
                ]
            )
            ->with(
                'success',
                'Weekly schedule updated successfully.'
            );
    }


    public function checkConflict(Request $request)
    {
        $request->validate([
            'schedule_id' => 'nullable|exists:schedules,id',
            'exclude_schedule_ids' => 'nullable',
            'professor_id' => 'nullable|exists:users,id',
            'room_id' => 'nullable|exists:classrooms,id',
            'slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'semester' => 'required|in:Semester 1,Semester 2',
            'academic_year' => 'nullable|string|max:20',
            'promotion' => 'nullable|integer|min:1|max:100',
            'year_levels' => 'required',
        ]);

        $yearLevels = $request->year_levels ?? [];

        if (!is_array($yearLevels)) {
            $yearLevels = [];
        }

        /*
        |--------------------------------------------------------------------------
        | SCHEDULES TO IGNORE
        |--------------------------------------------------------------------------
        | On Edit, the weekly schedules that are already part of the form are
        | existing records. They must not be reported as conflicts with
        | themselves. The Create page does not send this list, so its normal
        | conflict behaviour is unchanged.
        */
        $excludedIds = $request->input('exclude_schedule_ids', []);

        if (is_string($excludedIds)) {
            $decoded = json_decode($excludedIds, true);
            $excludedIds = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($excludedIds)) {
            $excludedIds = [];
        }

        if ($request->schedule_id) {
            $excludedIds[] = $request->schedule_id;
        }

        $excludedIds = collect($excludedIds)
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        /*
        |--------------------------------------------------------------------------
        | PROFESSOR CONFLICT
        |--------------------------------------------------------------------------
        */
        $professorConflict = false;

        if ($request->professor_id) {

            $professorConflict = Schedule::where(
                'professor_id',
                $request->professor_id
            )
                ->whereNotIn('id', $excludedIds ?: [0])
                ->where('day_of_week', $request->day_of_week)
                ->where('slot_id', $request->slot_id)
                ->where('semester', $request->semester)
                ->when($request->filled('academic_year'), function ($query) use ($request) {
                    $query->where('academic_year', $request->academic_year);
                })
                ->when($request->filled('promotion'), function ($query) use ($request) {
                    $query->where('promotion', $request->promotion);
                })
                ->exists();
        }


        /*
        |--------------------------------------------------------------------------
        | CLASSROOM CONFLICT
        |--------------------------------------------------------------------------
        */
        $classroomConflict = false;

        if ($request->room_id) {

            $classroomConflict = Schedule::where(
                'room_id',
                $request->room_id
            )
                ->whereNotIn('id', $excludedIds ?: [0])
                ->where('day_of_week', $request->day_of_week)
                ->where('slot_id', $request->slot_id)
                ->where('semester', $request->semester)
                ->when($request->filled('academic_year'), function ($query) use ($request) {
                    $query->where('academic_year', $request->academic_year);
                })
                ->when($request->filled('promotion'), function ($query) use ($request) {
                    $query->where('promotion', $request->promotion);
                })
                ->exists();
        }


        /*
        |--------------------------------------------------------------------------
        | YEAR LEVEL CONFLICT
        |--------------------------------------------------------------------------
        */
        $yearConflict = false;

        if (!empty($yearLevels)) {

            $yearConflict = Schedule::where(
                'day_of_week',
                $request->day_of_week
            )
                ->whereNotIn('id', $excludedIds ?: [0])
                ->where(
                    'slot_id',
                    $request->slot_id
                )
                ->where(
                    'semester',
                    $request->semester
                )
                ->when($request->filled('academic_year'), function ($query) use ($request) {
                    $query->where('academic_year', $request->academic_year);
                })
                ->when($request->filled('promotion'), function ($query) use ($request) {
                    $query->where('promotion', $request->promotion);
                })
                ->whereHas(
                    'scheduleDepartments',
                    function ($query) use ($yearLevels) {

                        $query->whereIn(
                            'year_level',
                            $yearLevels
                        );

                    }
                )
                ->exists();
        }


        $timeSlotConflict = false;

        if (!empty($yearLevels)) {

            $timeSlotConflict = Schedule::where(
                'day_of_week',
                $request->day_of_week
            )
                ->whereNotIn('id', $excludedIds ?: [0])
                ->where(
                    'slot_id',
                    $request->slot_id
                )
                ->where(
                    'semester',
                    $request->semester
                )
                ->when($request->filled('academic_year'), function ($query) use ($request) {
                    $query->where('academic_year', $request->academic_year);
                })
                ->when($request->filled('promotion'), function ($query) use ($request) {
                    $query->where('promotion', $request->promotion);
                })
                ->whereHas(
                    'scheduleDepartments',
                    function ($query) use ($yearLevels) {

                        $query->whereIn(
                            'year_level',
                            $yearLevels
                        );

                    }
                )
                ->exists();
        }


        return response()->json([
            'conflict' => (
                $professorConflict ||
                $classroomConflict ||
                $yearConflict
            ),
            'professor_conflict' => $professorConflict,
            'classroom_conflict' => $classroomConflict,
            'year_conflict' => $yearConflict,
            'time_slot_conflict' => $timeSlotConflict,
        ]);
    }

public function store(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    $request->validate([
        'semester' => 'required|in:Semester 1,Semester 2',

        'academic_year' => 'required|string|max:20',

        'promotion' => 'required|integer|min:1|max:100',

        'starting_date' => 'required|date',

        'finished_date' =>
            'required|date|after_or_equal:starting_date',

        'midterm_exam_start' =>
            'required|date',

        'midterm_exam_end' =>
            'required|date|after_or_equal:midterm_exam_start',

        'final_exam_start' =>
            'required|date',

        'final_exam_end' =>
            'required|date|after_or_equal:final_exam_start',

        'days' =>
            'required|array|min:1',

        'days.*' =>
            'array',

        'days.*.*.activity_type' =>
            'nullable|in:course,chapel,break,free,other',

        'days.*.*.special_note' =>
            'nullable|string|max:500',

        'days.*.*.course_id' =>
            'nullable|exists:courses,id',

        'days.*.*.professor_id' =>
            'nullable|exists:users,id',

        'days.*.*.teaching_mode' =>
            'nullable|in:offline,online',

        'days.*.*.room_id' =>
            'nullable|exists:classrooms,id',

        'days.*.*.slot_id' =>
            'required|exists:time_slots,id',

        'days.*.*.combined_years' =>
            'nullable|array',

        'days.*.*.combined_years.*' =>
            'integer|in:1,2,3,4',

        'main_year' =>
            'required|integer|in:1,2,3,4',
    ]);

    /** @var User $user */
    $user = Auth::user();

    $mainYear = (int) $request->main_year;

    /*
    |--------------------------------------------------------------------------
    | GET HOD DEPARTMENT
    |--------------------------------------------------------------------------
    */

    $department = $user->departments()
        ->where('head_id', $user->id)
        ->first();

    if (!$department) {
        abort(
            403,
            'You are not assigned as HoD of a department.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALID DAYS
    |--------------------------------------------------------------------------
    */

    $validDays = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
    ];

    /*
    |--------------------------------------------------------------------------
    | PREPARE ROWS
    |--------------------------------------------------------------------------
    */

    $preparedRows = [];

    foreach ($request->days as $day => $dayRows) {

        if (!in_array($day, $validDays, true)) {
            return back()
                ->withInput()
                ->withErrors([
                    'days' => 'Invalid schedule day selected.',
                ]);
        }

        foreach ($dayRows as $index => $row) {

            $activityType =
                $row['activity_type'] ?? 'course';

            $specialNote =
                $row['special_note'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | SPECIAL ACTIVITIES
            |--------------------------------------------------------------------------
            |
            | Chapel, Break, Free Time and Other do not require:
            | course, professor, or classroom.
            |
            */

            if ($activityType !== 'course') {

                $combinedYears = array_map(
                    'intval',
                    $row['combined_years'] ?? []
                );

                $yearLevels = array_unique(
                    array_merge(
                        [$mainYear],
                        $combinedYears
                    )
                );

                /*
                |--------------------------------------------------------------------------
                | CHECK YEAR LEVEL CONFLICT
                |--------------------------------------------------------------------------
                */

                $yearConflict = ScheduleDepartment::where(
                    'department_id',
                    $department->id
                )
                    ->whereIn(
                        'year_level',
                        $yearLevels
                    )
                    ->whereHas(
                        'schedule',
                        function ($query) use (
                            $request,
                            $row,
                            $day
                        ) {
                            $query
                                ->where(
                                    'day_of_week',
                                    $day
                                )
                                ->where(
                                    'slot_id',
                                    $row['slot_id']
                                )
                                ->where(
                                    'semester',
                                    $request->semester
                                );
                        }
                    )
                    ->exists();

                if ($yearConflict) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "days.{$day}.{$index}.activity_type" =>
                                'One or more selected year levels already have a schedule at this time.',
                        ]);
                }

                /*
                |--------------------------------------------------------------------------
                | PREPARE SPECIAL ACTIVITY
                |--------------------------------------------------------------------------
                */

                $preparedRows[] = [
                    'day' => $day,
                    'activity_type' => $activityType,
                    'special_note' => $specialNote,
                    'course_id' => null,
                    'professor_id' => null,
                    'room_id' => null,
                    'teaching_mode' => 'offline',
                    'slot_id' => $row['slot_id'],
                    'year_levels' => $yearLevels,
                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | NORMAL COURSE
            |--------------------------------------------------------------------------
            */

            /*
            | Completely empty course session.
            | Do not create a schedule record.
            */

            if (
                empty($row['course_id']) &&
                empty($row['professor_id']) &&
                empty($row['room_id'])
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | REQUIRE COMPLETE COURSE SESSION
            |--------------------------------------------------------------------------
            */

            if (
                empty($row['course_id']) ||
                empty($row['professor_id']) ||
                empty($row['room_id'])
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$day}.{$index}.course_id" =>
                            'Please complete the course, professor, and classroom for this session.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | GET YEAR LEVELS
            |--------------------------------------------------------------------------
            */

            $combinedYears = array_map(
                'intval',
                $row['combined_years'] ?? []
            );

            $yearLevels = array_unique(
                array_merge(
                    [$mainYear],
                    $combinedYears
                )
            );

            /*
            |--------------------------------------------------------------------------
            | CHECK COURSE BELONGS TO HOD DEPARTMENT
            |--------------------------------------------------------------------------
            */

            $course = Course::where(
                'id',
                $row['course_id']
            )
                ->where(
                    'department_id',
                    $department->id
                )
                ->first();

            if (!$course) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$day}.{$index}.course_id" =>
                            'This course does not belong to your department.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK PROFESSOR CONFLICT
            |--------------------------------------------------------------------------
            */

            $professorConflict = Schedule::where(
                'professor_id',
                $row['professor_id']
            )
                ->where(
                    'day_of_week',
                    $day
                )
                ->where(
                    'slot_id',
                    $row['slot_id']
                )
                ->where(
                    'semester',
                    $request->semester
                )
                ->exists();

            if ($professorConflict) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.$day.$index.professor_id" =>
                            'This professor already has a schedule at this time in this semester.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK CLASSROOM CONFLICT
            |--------------------------------------------------------------------------
            */

            $classroomConflict = Schedule::where(
                'room_id',
                $row['room_id']
            )
                ->where(
                    'day_of_week',
                    $day
                )
                ->where(
                    'slot_id',
                    $row['slot_id']
                )
                ->where(
                    'semester',
                    $request->semester
                )
                ->exists();

            if ($classroomConflict) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.$day.$index.room_id" =>
                            'This classroom is already occupied at this time in this semester.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK YEAR LEVEL CONFLICT
            |--------------------------------------------------------------------------
            */

            $yearConflict = ScheduleDepartment::where(
                'department_id',
                $department->id
            )
                ->whereIn(
                    'year_level',
                    $yearLevels
                )
                ->whereHas(
                    'schedule',
                    function ($query) use (
                        $request,
                        $row,
                        $day
                    ) {
                        $query
                            ->where(
                                'day_of_week',
                                $day
                            )
                            ->where(
                                'slot_id',
                                $row['slot_id']
                            )
                            ->where(
                                'semester',
                                $request->semester
                            );
                    }
                )
                ->exists();

            if ($yearConflict) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.$day.$index.combined_years" =>
                            'One or more selected year levels already have a schedule at this time.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | PREPARE COURSE ROW
            |--------------------------------------------------------------------------
            */

            $preparedRows[] = [
                'day' => $day,
                'activity_type' => 'course',
                'special_note' => null,
                'course_id' => $row['course_id'],
                'professor_id' => $row['professor_id'],
                'room_id' => $row['room_id'],
                'teaching_mode' => $row['teaching_mode'] ?? 'offline',
                'slot_id' => $row['slot_id'],
                'year_levels' => $yearLevels,
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK DUPLICATE SESSION SLOTS IN SAME FORM
    |--------------------------------------------------------------------------
    */

    $seenSlots = [];

    foreach ($preparedRows as $row) {

        $slotKey =
            $row['day'] . '-' . $row['slot_id'];

        if (isset($seenSlots[$slotKey])) {
            return back()
                ->withInput()
                ->withErrors([
                    "days.{$row['day']}.activity_type" =>
                        'This time slot is already used in another session for this day.',
                ]);
        }

        $seenSlots[$slotKey] = true;
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK CONFLICTS BETWEEN ROWS IN THIS SAME FORM
    |--------------------------------------------------------------------------
    */

    foreach ($preparedRows as $index => $current) {

        foreach ($preparedRows as $otherIndex => $other) {

            if ($index === $otherIndex) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | DIFFERENT DAY
            |--------------------------------------------------------------------------
            */

            if ($current['day'] !== $other['day']) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | DIFFERENT TIME
            |--------------------------------------------------------------------------
            */

            if (
                $current['slot_id'] != $other['slot_id']
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | PROFESSOR CONFLICT
            |--------------------------------------------------------------------------
            */

            if (
                !empty($current['professor_id']) &&
                !empty($other['professor_id']) &&
                $current['professor_id'] ==
                    $other['professor_id']
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$current['day']}.$index.professor_id" =>
                            'This professor is already selected in another row at this time.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CLASSROOM CONFLICT
            |--------------------------------------------------------------------------
            */

            if (
                !empty($current['room_id']) &&
                !empty($other['room_id']) &&
                $current['room_id'] ==
                    $other['room_id']
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$current['day']}.$index.room_id" =>
                            'This classroom is already selected in another row at this time.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | YEAR LEVEL CONFLICT
            |--------------------------------------------------------------------------
            */

            $sameYear = array_intersect(
                $current['year_levels'],
                $other['year_levels']
            );

            if (!empty($sameYear)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        "days.{$current['day']}.$index.activity_type" =>
                            'One or more selected year levels are already selected in another row at this time.',
                    ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE ALL ROWS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | IMPORTANT:
    |
    | Generate ONE group ID for the whole weekly timetable.
    |
    | Before:
    | Monday    = UUID A
    | Tuesday   = UUID B
    | Wednesday = UUID C
    | Thursday  = UUID D
    | Friday    = UUID E
    |
    | Now:
    | Monday    = UUID A
    | Tuesday   = UUID A
    | Wednesday = UUID A
    | Thursday  = UUID A
    | Friday    = UUID A
    |--------------------------------------------------------------------------
    */

    $scheduleGroupId = (string) Str::uuid();

    foreach ($preparedRows as $row) {

        /*
        |--------------------------------------------------------------------------
        | CREATE SCHEDULE
        |--------------------------------------------------------------------------
        */

        /*
        | Direct property assignment is used so activity_type and
        | special_note are saved even if they are not in $fillable.
        */

        $schedule = new Schedule();

        $schedule->activity_type =
            $row['activity_type'];

        $schedule->special_note =
            $row['special_note'];

        $schedule->course_id =
            $row['course_id'];

        $schedule->professor_id =
            $row['professor_id'];

        $schedule->room_id =
            $row['room_id'];

        $schedule->teaching_mode =
            $row['teaching_mode'] ?? 'offline';

        $schedule->day_of_week =
            $row['day'];

        $schedule->slot_id =
            $row['slot_id'];

        /*
        |--------------------------------------------------------------------------
        | COMMON WEEK INFORMATION
        |--------------------------------------------------------------------------
        */

        $schedule->semester =
            $request->semester;

        $schedule->academic_year =
            $request->academic_year;

        $schedule->promotion =
            $request->promotion;

        $schedule->starting_date =
            $request->starting_date;

        $schedule->finished_date =
            $request->finished_date;

        $schedule->midterm_exam_start =
            $request->midterm_exam_start;

        $schedule->midterm_exam_end =
            $request->midterm_exam_end;

        $schedule->final_exam_start =
            $request->final_exam_start;

        $schedule->final_exam_end =
            $request->final_exam_end;

        /*
        |--------------------------------------------------------------------------
        | INITIAL STATUS
        |--------------------------------------------------------------------------
        */

        $schedule->status =
            'draft';

        $schedule->created_by =
            $user->id;

        $schedule->approved_by =
            null;

        $schedule->note =
            $request->input('note');

        /*
        |--------------------------------------------------------------------------
        | SAVE SCHEDULE
        |--------------------------------------------------------------------------
        */

        $schedule->save();

        /*
        |--------------------------------------------------------------------------
        | SAVE DEPARTMENT / YEAR LEVEL RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        foreach ($row['year_levels'] as $yearLevel) {

            ScheduleDepartment::create([
                'schedule_id' =>
                    $schedule->id,

                'department_id' =>
                    $department->id,

                'year_level' =>
                    $yearLevel,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ASSIGN THE SAME GROUP ID
        |--------------------------------------------------------------------------
        */

        $schedule->forceFill([
            'schedule_group_id' =>
                $scheduleGroupId,
        ])->saveQuietly();
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('hod.schedules.index', [
            'year' => $request->main_year,
            'day' => 'Monday',
        ])
        ->with(
            'success',
            'Schedules created successfully.'
        );
}



public function destroy(Request $request, Schedule $schedule)
{
    /** @var User $user */
    $user = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | GET HOD DEPARTMENT
    |--------------------------------------------------------------------------
    */

    $department = $user->departments()
        ->where('head_id', $user->id)
        ->first();

    if (!$department) {
        abort(
            403,
            'You are not assigned as HoD of a department.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK ACCESS
    |--------------------------------------------------------------------------
    */

    $belongsToDepartment = $schedule->scheduleDepartments()
        ->where('department_id', $department->id)
        ->exists();

    if (!$belongsToDepartment) {
        abort(
            403,
            'You are not allowed to delete this schedule.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ENTIRE WEEKLY SCHEDULE
    |--------------------------------------------------------------------------
    |
    | A weekly schedule now uses ONE shared schedule_group_id
    | for Monday -> Friday.
    |
    */

    if ($request->input('delete_type') === 'week') {

        /*
        |--------------------------------------------------------------------------
        | GET THE GROUP ID
        |--------------------------------------------------------------------------
        */

        $scheduleGroupId = $schedule->schedule_group_id;

        /*
        |--------------------------------------------------------------------------
        | IF THIS IS A NEW PROPERLY GROUPED SCHEDULE
        |--------------------------------------------------------------------------
        */

        if ($scheduleGroupId) {

            $weeklySchedules = Schedule::query()
                ->where('schedule_group_id', $scheduleGroupId)
                ->get();

        }

        /*
        |--------------------------------------------------------------------------
        | LEGACY SUPPORT
        |--------------------------------------------------------------------------
        |
        | Older schedules were created with a different group ID
        | for each day.
        |
        | If no group ID exists, fall back to:
        |
        | Semester
        | Academic Year
        | Promotion
        | Department
        |
        */

        else {

            $weeklySchedules = Schedule::query()
                ->where('semester', $schedule->semester)
                ->where('academic_year', $schedule->academic_year)
                ->where('promotion', $schedule->promotion)
                ->whereIn('day_of_week', [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                ])
                ->whereHas(
                    'scheduleDepartments',
                    function ($query) use ($department) {
                        $query->where(
                            'department_id',
                            $department->id
                        );
                    }
                )
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE RELATIONSHIPS FIRST
        |--------------------------------------------------------------------------
        */

        foreach ($weeklySchedules as $weeklySchedule) {

            $weeklySchedule
                ->scheduleDepartments()
                ->delete();

        }

        /*
        |--------------------------------------------------------------------------
        | DELETE ALL SCHEDULE RECORDS
        |--------------------------------------------------------------------------
        */

        foreach ($weeklySchedules as $weeklySchedule) {

            $weeklySchedule->delete();

        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('hod.schedules.index', [
                'year' => $request->input('year', 'all'),
                'promotion' => $request->input('promotion', 'all'),
                'semester' => $request->input('semester', 'all'),
            ])
            ->with(
                'success',
                'Entire weekly schedule deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SINGLE SESSION DELETE
    |--------------------------------------------------------------------------
    */

    $year = $request->input('year', 'all');
    $promotion = $request->input('promotion', 'all');
    $semester = $request->input('semester', 'all');

    /*
    |--------------------------------------------------------------------------
    | DELETE DEPARTMENT RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    $schedule->scheduleDepartments()->delete();

    /*
    |--------------------------------------------------------------------------
    | DELETE SCHEDULE
    |--------------------------------------------------------------------------
    */

    $schedule->delete();

    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('hod.schedules.index', [
            'year' => $year,
            'promotion' => $promotion,
            'semester' => $semester,
        ])
        ->with(
            'success',
            'Session deleted successfully.'
        );
}


    // public function exportDocx(Schedule $schedule)
    // {
    //     return response()->json([
    //         'message' => 'DOCX export is connected.',
    //         'schedule_id' => $schedule->id,
    //     ]);
    // }



    // public function destroyDay(Request $request, Schedule $schedule)
    // {
    //     /** @var User $user */
    //     $user = Auth::user();

    //     $department = $user->departments()
    //         ->where('head_id', $user->id)
    //         ->first();

    //     if (!$department) {
    //         abort(403, 'You are not assigned as HoD of a department.');
    //     }

    //     $year = (int) $request->input('year', 1);

    //     if (!in_array($year, [1, 2, 3, 4], true)) {
    //         $year = 1;
    //     }

    //     $semester = $request->input('semester', 'Semester 1');

    //     if (!in_array($semester, ['Semester 1', 'Semester 2'], true)) {
    //         $semester = 'Semester 1';
    //     }

    //     $belongsToDepartmentAndYear = $schedule->scheduleDepartments()
    //         ->where('department_id', $department->id)
    //         ->where('year_level', $year)
    //         ->exists();

    //     if (!$belongsToDepartmentAndYear) {
    //         abort(403, 'You are not allowed to delete this schedule.');
    //     }

    //     $daySchedules = Schedule::where('day_of_week', $schedule->day_of_week)
    //         ->where('semester', $semester)
    //         ->whereHas('scheduleDepartments', function ($query) use ($department, $year) {
    //             $query->where('department_id', $department->id)
    //                 ->where('year_level', $year);
    //         })
    //         ->get();

    //     foreach ($daySchedules as $daySchedule) {
    //         $daySchedule->scheduleDepartments()
    //             ->where('department_id', $department->id)
    //             ->where('year_level', $year)
    //             ->delete();

    //         if (!$daySchedule->scheduleDepartments()->exists()) {
    //             $daySchedule->delete();
    //         }
    //     }

    //     return redirect()
    //         ->route('hod.schedules.index', [
    //             'year' => $year,
    //             'day' => $schedule->day_of_week,
    //             'semester' => $semester,
    //         ])
    //         ->with(
    //             'success',
    //             "All {$semester} sessions for {$schedule->day_of_week} were deleted successfully."
    //         );
    // }


public function exportDocx(Schedule $schedule)
{
    /** @var User $user */
    $user = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | CHECK HOD DEPARTMENT
    |--------------------------------------------------------------------------
    */

    $department = $user->departments()
        ->with('head')
        ->where('head_id', $user->id)
        ->first();

    if (!$department) {
        abort(403, 'You are not assigned as HoD of a department.');
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK SCHEDULE ACCESS
    |--------------------------------------------------------------------------
    */

    $belongsToDepartment = $schedule->scheduleDepartments()
        ->where('department_id', $department->id)
        ->exists();

    if (!$belongsToDepartment) {
        abort(403, 'You are not allowed to export this schedule.');
    }

    /*
    |--------------------------------------------------------------------------
    | GET MAIN YEAR
    |--------------------------------------------------------------------------
    */

    $year = $schedule->scheduleDepartments()
        ->where('department_id', $department->id)
        ->value('year_level');

    $year = (int) ($year ?? 1);

    /*
    |--------------------------------------------------------------------------
    | GET TIME SLOTS
    |--------------------------------------------------------------------------
    */

    $timeSlots = TimeSlot::orderBy('session_number')
        ->take(4)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | GET WHOLE WEEKLY SCHEDULE
    |--------------------------------------------------------------------------
    */

    $schedules = Schedule::with([
        'course',
        'professor',
        'room',
        'timeSlot',
        'scheduleDepartments',
    ])
        ->where('schedule_group_id', $schedule->schedule_group_id)
        ->whereIn('day_of_week', [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ])
        ->whereIn('slot_id', $timeSlots->pluck('id'))
        ->orderByRaw("
            FIELD(
                day_of_week,
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday'
            )
        ")
        ->orderBy('slot_id')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | CREATE WORD DOCUMENT
    |--------------------------------------------------------------------------
    */

    $phpWord = new PhpWord();

    $phpWord->setDefaultFontName('Times New Roman');
    $phpWord->setDefaultFontSize(10);

    /*
    |--------------------------------------------------------------------------
    | LANDSCAPE A4 PAGE
    |--------------------------------------------------------------------------
    */

    $section = $phpWord->addSection([
        'orientation' => 'landscape',
        'paper' => 'A4',
        'pageSizeW' => 16838,
        'pageSizeH' => 11906,
        'marginTop' => 350,
        'marginBottom' => 350,
        'marginLeft' => 500,
        'marginRight' => 500,
    ]);

    /*
    |--------------------------------------------------------------------------
    | SEMESTER LABEL
    |--------------------------------------------------------------------------
    */

    $semesterText = match ($schedule->semester) {
        'Semester 1' => 'FIRST SEMESTER',
        'Semester 2' => 'SECOND SEMESTER',
        default => strtoupper($schedule->semester),
    };

    /*
    |--------------------------------------------------------------------------
    | COMMON PARAGRAPH STYLES
    |--------------------------------------------------------------------------
    */

    $centerParagraph = [
        'alignment' => Jc::CENTER,
        'spaceBefore' => 0,
        'spaceAfter' => 0,
        'lineHeight' => 1.0,
    ];

    $leftParagraph = [
        'alignment' => Jc::LEFT,
        'spaceBefore' => 0,
        'spaceAfter' => 0,
        'lineHeight' => 1.0,
    ];

    /*
    |--------------------------------------------------------------------------
    | DOCUMENT HEADER
    |--------------------------------------------------------------------------
    */

    $topTable = $section->addTable([
        'alignment' => JcTable::CENTER,
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'cellMargin' => 0,
        'width' => 15800,
        'layout' => 'fixed',
    ]);

    $topTable->addRow(1250);

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY LOGO
    |--------------------------------------------------------------------------
    */

    $logoCell = $topTable->addCell(2300, [
        'valign' => 'center',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    $logoPath = public_path('assets/img/Life_circle_blue_LG.png');

    if (file_exists($logoPath)) {
        $logoCell->addImage($logoPath, [
            'width' => 82,
            'height' => 82,
            'alignment' => Jc::CENTER,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY INFORMATION
    |--------------------------------------------------------------------------
    */

    $titleCell = $topTable->addCell(13500, [
        'valign' => 'center',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    $titleCell->addText(
        'LIFE UNIVERSITY',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        $centerParagraph
    );

    $titleCell->addText(
        'COLLEGE SCIENCE AND ENGINEERING',
        [
            'name' => 'Times New Roman',
            'size' => 13,
            'color' => '000000',
        ],
        $centerParagraph
    );

    $titleCell->addText(
        'BACHELOR DEGREE OF COMPUTER SCIENCE YEAR ' . $year,
        [
            'name' => 'Times New Roman',
            'size' => 12,
            'color' => '000000',
        ],
        $centerParagraph
    );

    $titleCell->addText(
        'PROMOTION ' . $schedule->promotion . ', ' . $semesterText,
        [
            'name' => 'Times New Roman',
            'size' => 12,
            'color' => '000000',
        ],
        $centerParagraph
    );

    $titleCell->addText(
        'ACADEMIC : ' . str_replace('-', ' – ', $schedule->academic_year),
        [
            'name' => 'Times New Roman',
            'size' => 12,
            'color' => '000000',
        ],
        $centerParagraph
    );

    /*
    |--------------------------------------------------------------------------
    | SPACE BEFORE SCHEDULE TABLE
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE TABLE
    |--------------------------------------------------------------------------
    */

    $table = $section->addTable([
        'alignment' => JcTable::CENTER,
        'borderSize' => 6,
        'borderColor' => '000000',
        'cellMargin' => 35,
        'width' => 15800,
        'layout' => 'fixed',
    ]);

    /*
    |--------------------------------------------------------------------------
    | TABLE HEADER
    |--------------------------------------------------------------------------
    */

    $table->addRow(500);

    $headings = [
        'TIME',
        'MONDAY',
        'TUESDAY',
        'WEDNESDAY',
        'THURSDAY',
        'FRIDAY',
    ];

    foreach ($headings as $heading) {
        $cellWidth = $heading === 'TIME' ? 1750 : 2810;

        $headerCell = $table->addCell($cellWidth, [
            'bgColor' => '7CCFE3',
            'valign' => 'center',
            'borderSize' => 6,
            'borderColor' => '000000',
        ]);

        $headerCell->addText(
            $heading,
            [
                'name' => 'Times New Roman',
                'size' => 11,
                'bold' => true,
                'color' => '000000',
            ],
            $centerParagraph
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE ROWS
    |--------------------------------------------------------------------------
    */

    foreach ($timeSlots as $timeSlot) {
        $rowHeight = $timeSlot->session_number == 3
            ? 650
            : 1050;

        $table->addRow($rowHeight);

        $start = date(
            'g:iA',
            strtotime($timeSlot->start_time)
        );

        $end = date(
            'g:iA',
            strtotime($timeSlot->end_time)
        );

        /*
        |--------------------------------------------------------------------------
        | TIME CELL
        |--------------------------------------------------------------------------
        */

        $timeCell = $table->addCell(1750, [
            'valign' => 'center',
            'borderSize' => 6,
            'borderColor' => '000000',
        ]);

        $timeCell->addText(
            $start . '-' . $end,
            [
                'name' => 'Times New Roman',
                'size' => 9,
                'bold' => true,
                'color' => '000000',
            ],
            $centerParagraph
        );

        /*
        |--------------------------------------------------------------------------
        | MONDAY TO FRIDAY
        |--------------------------------------------------------------------------
        */

        foreach (
            ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']
            as $day
        ) {
            $cell = $table->addCell(2810, [
                'valign' => 'center',
                'borderSize' => 6,
                'borderColor' => '000000',
            ]);

            $daySchedule = $schedules
                ->where('day_of_week', $day)
                ->where('slot_id', $timeSlot->id)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | EMPTY CELL
            |--------------------------------------------------------------------------
            */

            if (!$daySchedule) {
                $cell->addText(
                    '—',
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'color' => 'A6A6A6',
                    ],
                    $centerParagraph
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | SPECIAL ACTIVITIES
            |--------------------------------------------------------------------------
            */

            if (($daySchedule->activity_type ?? 'course') !== 'course') {
                $activityLabel = match ($daySchedule->activity_type) {
                    'chapel' => 'Chapel',
                    'break' => 'Break',
                    'free' => 'Free Time',
                    'other' => 'Other',
                    default => 'Other',
                };

                $cell->addText(
                    $activityLabel,
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'bold' => true,
                        'color' => '000000',
                    ],
                    [
                        'alignment' => Jc::CENTER,
                        'spaceBefore' => 0,
                        'spaceAfter' => 60,
                        'lineHeight' => 1.0,
                    ]
                );

                if (!empty($daySchedule->special_note)) {
                    $cell->addText(
                        $daySchedule->special_note,
                        [
                            'name' => 'Times New Roman',
                            'size' => 9,
                            'color' => '000000',
                        ],
                        $centerParagraph
                    );
                }

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | COURSE INFORMATION
            |--------------------------------------------------------------------------
            */

            $courseName = $daySchedule->course?->course_name ?? '';
            $professorName = $daySchedule->professor?->name ?? '';
            $roomName = $daySchedule->room?->room_name ?? '';

            /*
            |--------------------------------------------------------------------------
            | COURSE NAME
            |--------------------------------------------------------------------------
            */

            $cell->addText(
                $courseName,
                [
                    'name' => 'Times New Roman',
                    'size' => 10,
                    'color' => '000000',
                ],
                [
                    'alignment' => Jc::CENTER,
                    'spaceBefore' => 0,
                    'spaceAfter' => 40,
                    'lineHeight' => 1.0,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | PROFESSOR NAME
            |--------------------------------------------------------------------------
            */

            if (!empty($professorName)) {
                $cell->addText(
                    '(Prof. ' . $professorName . ')',
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'color' => '000000',
                    ],
                    [
                        'alignment' => Jc::CENTER,
                        'spaceBefore' => 0,
                        'spaceAfter' => 40,
                        'lineHeight' => 1.0,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | COMBINED YEAR
            |--------------------------------------------------------------------------
            */

            $combinedYears = $daySchedule->scheduleDepartments
                ->where('department_id', $department->id)
                ->pluck('year_level')
                ->map(fn ($yearLevel) => (int) $yearLevel)
                ->filter(fn ($yearLevel) => $yearLevel !== $year)
                ->unique()
                ->sort()
                ->values();

            $romanYears = $combinedYears->map(function ($yearLevel) {
                return match ($yearLevel) {
                    1 => 'I',
                    2 => 'II',
                    3 => 'III',
                    4 => 'IV',
                    5 => 'V',
                    6 => 'VI',
                    default => (string) $yearLevel,
                };
            });

            if ($romanYears->isNotEmpty()) {
                $combinedYearText = 'Combine Year ' .
                    $romanYears->implode(', ');

                $cell->addText(
                    $combinedYearText,
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'bold' => false,
                        'color' => 'FF0000',
                    ],
                    [
                        'alignment' => Jc::CENTER,
                        'spaceBefore' => 0,
                        'spaceAfter' => 40,
                        'lineHeight' => 1.0,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | TEACHING MODE
            |--------------------------------------------------------------------------
            */

            $teachingMode = ucfirst(
                $daySchedule->teaching_mode ?? 'offline'
            );

            $cell->addText(
                $teachingMode,
                [
                    'name' => 'Times New Roman',
                    'size' => 10,
                    'color' => '000000',
                ],
                [
                    'alignment' => Jc::CENTER,
                    'spaceBefore' => 0,
                    'spaceAfter' => 40,
                    'lineHeight' => 1.0,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | ROOM
            |--------------------------------------------------------------------------
            */

            if (!empty($roomName)) {
                $cell->addText(
                    'Room : ' . $roomName,
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'color' => '000000',
                    ],
                    [
                        'alignment' => Jc::CENTER,
                        'spaceBefore' => 0,
                        'spaceAfter' => 0,
                        'lineHeight' => 1.0,
                    ]
                );
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SPACE AFTER SCHEDULE TABLE
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    /*
    |--------------------------------------------------------------------------
    | DATES TABLE
    |--------------------------------------------------------------------------
    */

    $dateTable = $section->addTable([
        'alignment' => JcTable::CENTER,
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'cellMargin' => 0,
        'width' => 15800,
        'layout' => 'fixed',
    ]);

    $dateTable->addRow(450);

    /*
    |--------------------------------------------------------------------------
    | LEFT DATES
    |--------------------------------------------------------------------------
    */

    $leftDateCell = $dateTable->addCell(7900, [
        'valign' => 'center',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    $leftDateCell->addText(
        'Starting Date: ' . (
            $schedule->starting_date
                ? date('d/m/Y', strtotime($schedule->starting_date))
                : ''
        ),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        $leftParagraph
    );

    $leftDateCell->addText(
        'Finished Date: ' . (
            $schedule->finished_date
                ? date('d/m/Y', strtotime($schedule->finished_date))
                : ''
        ),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        $leftParagraph
    );

    /*
    |--------------------------------------------------------------------------
    | RIGHT DATES
    |--------------------------------------------------------------------------
    */

    $rightDateCell = $dateTable->addCell(7900, [
        'valign' => 'center',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    $rightDateCell->addText(
        'Mid-Term Exam: ' . (
            $schedule->midterm_exam_start
                ? date('d/m/Y', strtotime($schedule->midterm_exam_start))
                : ''
        ),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        $leftParagraph
    );

    $rightDateCell->addText(
        'Final Exam: ' . (
            $schedule->final_exam_start
                ? date('d/m/Y', strtotime($schedule->final_exam_start))
                : ''
        ),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        $leftParagraph
    );

    /*
    |--------------------------------------------------------------------------
    | NOTE
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    $section->addText(
        'Note: Professors/Lecturers are asked to give the final exam in softcopy to Academic office at least 2 weeks before the final examination',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );
/*
|--------------------------------------------------------------------------
| APPROVAL SECTION
|--------------------------------------------------------------------------
|
| The approval names use normal size 10 with spacing before them.
| The department titles remain normal size.
| No addTextBreak() is used between the title and name.
|
*/

$section->addTextBreak(1);

/*
|--------------------------------------------------------------------------
| APPROVAL DATE
|--------------------------------------------------------------------------
*/

$approvalDate = 'Date: ' . (
    $schedule->starting_date
        ? date('d/m/Y', strtotime($schedule->starting_date))
        : ''
);

/*
|--------------------------------------------------------------------------
| YEAR 1 APPROVAL
|--------------------------------------------------------------------------
*/

if ($year === 1) {
    /*
    |--------------------------------------------------------------------------
    | DATE
    |--------------------------------------------------------------------------
    */

    $section->addText(
        $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT TITLE
    |--------------------------------------------------------------------------
    */

    $section->addText(
        'HEAD OF FOUNDATION YEAR DEPARTMENT',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | HOD SIGNATURE NAME
    |--------------------------------------------------------------------------
    */

    $section->addText(
        'SOEUNG SAMBATH',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 420,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => false,
            'keepLines' => false,
        ]
    );
} else {
    /*
    |--------------------------------------------------------------------------
    | OTHER YEARS APPROVAL
    |--------------------------------------------------------------------------
    */

    $approvalTable = $section->addTable([
        'alignment' => JcTable::CENTER,
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'cellMargin' => 0,
        'width' => 15800,
        'layout' => 'fixed',
    ]);

    $approvalTable->addRow(700);

    /*
    |--------------------------------------------------------------------------
    | LEFT APPROVAL
    |--------------------------------------------------------------------------
    */

    $leftApproval = $approvalTable->addCell(7900, [
        'valign' => 'top',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    /*
    |--------------------------------------------------------------------------
    | LEFT DATE
    |--------------------------------------------------------------------------
    */

    $leftApproval->addText(
        $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | ACADEMIC OFFICE TITLE
    |--------------------------------------------------------------------------
    */

    $leftApproval->addText(
        'HEAD OF ACADEMIC OFFICE',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 550,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | ACADEMIC OFFICE SIGNATURE NAME
    |--------------------------------------------------------------------------
    */

    $leftApproval->addText(
        'LEC. SAN PISETH',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 420,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => false,
            'keepLines' => false,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | RIGHT APPROVAL
    |--------------------------------------------------------------------------
    */

    $rightApproval = $approvalTable->addCell(7900, [
        'valign' => 'top',
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
    ]);

    /*
    |--------------------------------------------------------------------------
    | RIGHT DATE
    |--------------------------------------------------------------------------
    */

    $rightApproval->addText(
        $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT TITLE
    |--------------------------------------------------------------------------
    */

    $rightApproval->addText(
        'HEAD OF ' . strtoupper($department->department_name),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => true,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT HEAD SIGNATURE NAME
    |--------------------------------------------------------------------------
    */

    $rightApproval->addText(
        'LEC. ' . strtoupper(
            $department->head?->name
                ?? 'DEPARTMENT HEAD NOT ASSIGNED'
        ),
        [
            'name' => 'Times New Roman',
            'size' => 16,
            'bold' => true,
            'color' => '000000',
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 550,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
            'keepNext' => false,
            'keepLines' => false,
        ]
    );
}
    /*
    |--------------------------------------------------------------------------
    | SAVE AND DOWNLOAD DOCX
    |--------------------------------------------------------------------------
    */

    $filename = 'schedule_' . $schedule->id . '.docx';

    $writer = IOFactory::createWriter(
        $phpWord,
        'Word2007'
    );

    $tempFile = tempnam(
        sys_get_temp_dir(),
        'schedule_'
    );

    $writer->save($tempFile);

    return response()
        ->download($tempFile, $filename)
        ->deleteFileAfterSend(true);
}

public function previewDocx(Schedule $schedule)
{
    /** @var User $user */
    $user = Auth::user();

    $department = $user->departments()
        ->with('head')
        ->where('head_id', $user->id)
        ->first();

    if (!$department) {
        abort(403, 'You are not assigned as HoD of a department.');
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK ACCESS
    |--------------------------------------------------------------------------
    */

    $belongsToDepartment = $schedule->scheduleDepartments()
        ->where('department_id', $department->id)
        ->exists();

    if (!$belongsToDepartment) {
        abort(403, 'You are not allowed to preview this schedule.');
    }

    /*
    |--------------------------------------------------------------------------
    | GET MAIN YEAR
    |--------------------------------------------------------------------------
    */

    $year = $schedule->scheduleDepartments()
        ->where('department_id', $department->id)
        ->value('year_level');

    $year = (int) ($year ?? 1);

    /*
    |--------------------------------------------------------------------------
    | TIME SLOTS
    |--------------------------------------------------------------------------
    */

    $timeSlots = TimeSlot::orderBy('session_number')
        ->take(4)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | GET WHOLE WEEK
    |--------------------------------------------------------------------------
    |
    | All Monday-Friday sessions belong to the same schedule_group_id.
    | So load the entire weekly schedule using that shared group ID.
    |
    */

    $schedules = Schedule::with([
        'course',
        'professor',
        'room',
        'timeSlot',
        'scheduleDepartments',
    ])
        ->where('schedule_group_id', $schedule->schedule_group_id)
        ->whereIn('day_of_week', [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ])
        ->whereIn('slot_id', $timeSlots->pluck('id'))
        ->orderByRaw("
            FIELD(
                day_of_week,
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday'
            )
        ")
        ->orderBy('slot_id')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | SEMESTER LABEL
    |--------------------------------------------------------------------------
    */

    $semesterText = match ($schedule->semester) {
        'Semester 1' => 'FIRST SEMESTER',
        'Semester 2' => 'SECOND SEMESTER',
        default => strtoupper($schedule->semester),
    };

    return view('hod.schedules.preview-docx', compact(
        'schedule',
        'department',
        'year',
        'semesterText',
        'timeSlots',
        'schedules'
    ));
}
}
