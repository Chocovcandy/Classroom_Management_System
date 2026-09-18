<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;

class StudentScheduleController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | GET ALL STUDENT DEPARTMENTS
        |--------------------------------------------------------------------------
        |
        | Load all departments so the dropdown can show:
        | CS, English, Chinese, etc.
        |
        */
        $departments = Department::query()
            ->orderBy('department_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | GET FILTER VALUES
        |--------------------------------------------------------------------------
        */
        $yearLevels = collect([1, 2, 3, 4]);

        $semesters = collect([
            'Semester 1',
            'Semester 2',
        ]);

        /*
        |--------------------------------------------------------------------------
        | GET ACADEMIC YEARS
        |--------------------------------------------------------------------------
        */
        $academicYears = Schedule::query()
            ->whereNotNull('academic_year')
            ->where('status', 'published')
            ->select('academic_year')
            ->distinct()
            ->orderByDesc('academic_year')
            ->pluck('academic_year');

        /*
        |--------------------------------------------------------------------------
        | SELECTED FILTERS
        |--------------------------------------------------------------------------
        */
        $selectedDepartment = null;
        $selectedSchedule = null;
        $schedules = collect();

        /*
        |--------------------------------------------------------------------------
        | ALWAYS LOAD ALL 4 TIME SLOTS
        |--------------------------------------------------------------------------
        |
        | The student timetable should keep the same 4-session structure
        | as the HoD preview.
        |
        */
        $availableTimeSlots = TimeSlot::query()
            ->orderBy('session_number')
            ->take(4)
            ->get();

/*
|--------------------------------------------------------------------------
| REMEMBER STUDENT SCHEDULE SELECTION
|--------------------------------------------------------------------------
*/

$sessionKey = 'student_schedule_selection';

$departmentId = $request->query('department_id');
$yearLevel = $request->query('year_level');
$semester = $request->query('semester');
$academicYear = $request->query('academic_year');

/*
|--------------------------------------------------------------------------
| SAVE NEW SELECTION
|--------------------------------------------------------------------------
|
| Save only when all four values are selected.
| This prevents incomplete selections from overwriting
| the student's previous valid schedule.
|
*/

if (
    filled($departmentId) &&
    filled($yearLevel) &&
    filled($semester) &&
    filled($academicYear)
) {
    $request->session()->put($sessionKey, [
        'department_id' => (int) $departmentId,
        'year_level' => (int) $yearLevel,
        'semester' => $semester,
        'academic_year' => $academicYear,
    ]);
}

/*
|--------------------------------------------------------------------------
| LOAD REMEMBERED SELECTION
|--------------------------------------------------------------------------
|
| If the page is opened without query parameters,
| use the student's previously selected schedule.
|
*/

$savedSelection = $request->session()->get($sessionKey, []);

$departmentId = filled($departmentId)
    ? (int) $departmentId
    : ($savedSelection['department_id'] ?? null);

$yearLevel = filled($yearLevel)
    ? (int) $yearLevel
    : ($savedSelection['year_level'] ?? null);

$semester = filled($semester)
    ? $semester
    : ($savedSelection['semester'] ?? null);

$academicYear = filled($academicYear)
    ? $academicYear
    : ($savedSelection['academic_year'] ?? null);

        /*
        |--------------------------------------------------------------------------
        | SEARCH STATUS
        |--------------------------------------------------------------------------
        */
        $searched = $request->filled([
            'department_id',
            'year_level',
            'semester',
            'academic_year',
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOAD SELECTED DEPARTMENT
        |--------------------------------------------------------------------------
        */
        if ($departmentId) {
            $selectedDepartment = $departments->firstWhere(
                'id',
                (int) $departmentId
            );
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD STUDENT SCHEDULE
        |--------------------------------------------------------------------------
        */
        if (
            $departmentId &&
            $yearLevel &&
            $semester &&
            $academicYear
        ) {

            /*
            |--------------------------------------------------------------------------
            | STEP 1: FIND ONE SCHEDULE THAT BELONGS TO THE
            | SELECTED DEPARTMENT + YEAR
            |--------------------------------------------------------------------------
            |
            | This is used only to identify the weekly schedule group.
            |
            */
            $selectedSchedule = Schedule::with([
                'course',
                'professor',
                'room',
                'timeSlot',
                'scheduleDepartments',
            ])
                ->whereHas('scheduleDepartments', function ($query) use (
                    $departmentId,
                    $yearLevel
                ) {
                    $query
                        ->where('department_id', (int) $departmentId)
                        ->where('year_level', (int) $yearLevel);
                })
                ->where('semester', $semester)
                ->where('academic_year', $academicYear)
                ->where('status', 'published')
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
                ->first();

            /*
            |--------------------------------------------------------------------------
            | STEP 2: LOAD THE COMPLETE WEEK
            |--------------------------------------------------------------------------
            |
            | New schedules share one schedule_group_id for all
            | Monday-Friday sessions.
            |
            | This means Chapel, Break, Free Time, etc. are also loaded
            | instead of being removed by the department/year filter.
            |
            */
            if ($selectedSchedule) {

                $weeklyQuery = Schedule::with([
                    'course',
                    'professor',
                    'room',
                    'timeSlot',
                    'scheduleDepartments',
                ])
                    ->where('semester', $selectedSchedule->semester)
                    ->where('academic_year', $selectedSchedule->academic_year)
                    ->where('promotion', $selectedSchedule->promotion)
                    ->where('status', 'published')
                    ->whereIn('day_of_week', [
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                    ])
                    ->whereIn(
                        'slot_id',
                        $availableTimeSlots->pluck('id')
                    );

                /*
                |--------------------------------------------------------------------------
                | NEW WEEKLY RECORDS
                |--------------------------------------------------------------------------
                */
                if (!empty($selectedSchedule->schedule_group_id)) {

                    $weeklyQuery->where(
                        'schedule_group_id',
                        $selectedSchedule->schedule_group_id
                    );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | OLD RECORDS WITHOUT schedule_group_id
                    |--------------------------------------------------------------------------
                    |
                    | Keep compatibility with schedules created before
                    | schedule_group_id was used correctly.
                    |
                    */
                    $weeklyQuery->whereHas(
                        'scheduleDepartments',
                        function ($query) use (
                            $departmentId,
                            $yearLevel
                        ) {
                            $query
                                ->where(
                                    'department_id',
                                    (int) $departmentId
                                )
                                ->where(
                                    'year_level',
                                    (int) $yearLevel
                                );
                        }
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | GET COMPLETE WEEK
                |--------------------------------------------------------------------------
                */
                $schedules = $weeklyQuery
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
            }
        }

        /*
        |--------------------------------------------------------------------------
        | WEEKDAYS
        |--------------------------------------------------------------------------
        */
        $weekdays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ];

        /*
        |--------------------------------------------------------------------------
        | FORMAT TIME
        |--------------------------------------------------------------------------
        */
        $formatTime = function ($time) {

            if (!$time) {
                return '—';
            }

            return Carbon::parse($time)->format('h:i A');
        };

        /*
        |--------------------------------------------------------------------------
        | FIND SCHEDULE FOR DAY AND TIME SLOT
        |--------------------------------------------------------------------------
        */
        $getSchedule = function ($day, $slotId) use ($schedules) {

            return $schedules->first(
                function ($schedule) use (
                    $day,
                    $slotId
                ) {
                    return $schedule->day_of_week === $day
                        && (int) $schedule->slot_id === (int) $slotId;
                }
            );
        };

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('student.schedules.index', compact(
            'departments',
            'yearLevels',
            'semesters',
            'academicYears',
            'selectedDepartment',
            'selectedSchedule',
            'schedules',
            'availableTimeSlots',
            'weekdays',
            'formatTime',
            'getSchedule',
            'searched'
        ));
    }

public function downloadDocx(Request $request)
{
    $departmentId = $request->query('department_id');
    $yearLevel = $request->query('year_level');
    $semester = $request->query('semester');
    $academicYear = $request->query('academic_year');

    if (!$departmentId || !$yearLevel || !$semester || !$academicYear) {
        abort(422, 'Please select your complete schedule information first.');
    }

    $yearLevel = (int) $yearLevel;

    if (!in_array($yearLevel, [1, 2, 3, 4], true)) {
        abort(422, 'Invalid year level.');
    }

    if (!in_array($semester, ['Semester 1', 'Semester 2'], true)) {
        abort(422, 'Invalid semester.');
    }

    $department = Department::with('head')->find((int) $departmentId);

    if (!$department) {
        abort(404, 'Department not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | FIND SELECTED PUBLISHED SCHEDULE
    |--------------------------------------------------------------------------
    */

    $selectedSchedule = Schedule::with([
        'course',
        'professor',
        'room',
        'timeSlot',
        'scheduleDepartments',
    ])
        ->whereHas('scheduleDepartments', function ($query) use (
            $departmentId,
            $yearLevel
        ) {
            $query
                ->where('department_id', (int) $departmentId)
                ->where('year_level', $yearLevel);
        })
        ->where('semester', $semester)
        ->where('academic_year', $academicYear)
        ->where('status', 'published')
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
        ->first();

    if (!$selectedSchedule) {
        abort(404, 'No published schedule was found for this selection.');
    }

    /*
    |--------------------------------------------------------------------------
    | TIME SLOTS
    |--------------------------------------------------------------------------
    */

    $timeSlots = TimeSlot::query()
        ->orderBy('session_number')
        ->take(4)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | COMPLETE WEEK
    |--------------------------------------------------------------------------
    */

    $weeklyQuery = Schedule::with([
        'course',
        'professor',
        'room',
        'timeSlot',
        'scheduleDepartments',
    ])
        ->where('semester', $selectedSchedule->semester)
        ->where('academic_year', $selectedSchedule->academic_year)
        ->where('promotion', $selectedSchedule->promotion)
        ->where('status', 'published')
        ->whereIn('day_of_week', [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ])
        ->whereIn('slot_id', $timeSlots->pluck('id'));

    if (!empty($selectedSchedule->schedule_group_id)) {
        $weeklyQuery->where(
            'schedule_group_id',
            $selectedSchedule->schedule_group_id
        );
    } else {
        $weeklyQuery->whereHas(
            'scheduleDepartments',
            function ($query) use ($departmentId, $yearLevel) {
                $query
                    ->where('department_id', (int) $departmentId)
                    ->where('year_level', $yearLevel);
            }
        );
    }

    $schedules = $weeklyQuery
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

    if ($schedules->isEmpty()) {
        abort(404, 'The selected weekly schedule is not available.');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE WORD DOCUMENT
    |--------------------------------------------------------------------------
    */

    $phpWord = new PhpWord();

    $phpWord->setDefaultFontName('Times New Roman');
    $phpWord->setDefaultFontSize(10);

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

    $semesterText = match ($selectedSchedule->semester) {
        'Semester 1' => 'FIRST SEMESTER',
        'Semester 2' => 'SECOND SEMESTER',
        default => strtoupper($selectedSchedule->semester),
    };

    $days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
    ];

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

    $normalFont = [
        'name' => 'Times New Roman',
        'size' => 10,
        'color' => '000000',
    ];

    $boldFont = [
        'name' => 'Times New Roman',
        'size' => 10,
        'bold' => true,
        'color' => '000000',
    ];

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY HEADER
    |--------------------------------------------------------------------------
    */

    $headerTable = $section->addTable([
        'alignment' => JcTable::CENTER,
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'cellMargin' => 0,
        'width' => 15800,
        'layout' => 'fixed',
    ]);

    $headerTable->addRow(1250);

    $headerLeft = $headerTable->addCell(2300, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'center',
    ]);

    $logoPath = public_path('assets/img/Life_circle_blue_LG.png');

    if (is_file($logoPath)) {
        $headerLeft->addImage(
            $logoPath,
            [
                'width' => 82,
                'height' => 82,
                'alignment' => Jc::CENTER,
            ]
        );
    }

    $headerRight = $headerTable->addCell(13500, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'center',
    ]);

    $headerRight->addText(
        'LIFE UNIVERSITY',
        [
            'name' => 'Times New Roman',
            'size' => 16,
            'bold' => true,
        ],
        $centerParagraph
    );

    $headerRight->addText(
        'COLLEGE SCIENCE AND ENGINEERING',
        [
            'name' => 'Times New Roman',
            'size' => 13,
            'bold' => true,
        ],
        $centerParagraph
    );

    $headerRight->addText(
        'BACHELOR DEGREE OF COMPUTER SCIENCE YEAR ' . $yearLevel,
        [
            'name' => 'Times New Roman',
            'size' => 12,
            'bold' => true,
        ],
        $centerParagraph
    );

    $promotionText = $selectedSchedule->promotion
        ? 'PROMOTION ' . $selectedSchedule->promotion . ', '
        : '';

    $headerRight->addText(
        $promotionText . $semesterText,
        [
            'name' => 'Times New Roman',
            'size' => 12,
        ],
        $centerParagraph
    );

    $headerRight->addText(
        'ACADEMIC : ' .
            str_replace('-', ' – ', $selectedSchedule->academic_year),
        [
            'name' => 'Times New Roman',
            'size' => 12,
        ],
        $centerParagraph
    );

    $section->addTextBreak(1);

    /*
    |--------------------------------------------------------------------------
    | WEEKLY SCHEDULE TABLE
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

    $table->addRow(500);

    $table->addCell(1750, [
        'valign' => 'center',
        'bgColor' => '7CCFE3',
    ])->addText(
        'TIME',
        [
            'name' => 'Times New Roman',
            'size' => 11,
            'bold' => true,
        ],
        $centerParagraph
    );

    foreach ($days as $dayName) {
        $table->addCell(2810, [
            'valign' => 'center',
            'bgColor' => '7CCFE3',
        ])->addText(
            strtoupper($dayName),
            [
                'name' => 'Times New Roman',
                'size' => 11,
                'bold' => true,
            ],
            $centerParagraph
        );
    }

    foreach ($timeSlots as $timeSlot) {
        $rowHeight = $timeSlot->session_number == 3
            ? 650
            : 1050;

        $table->addRow($rowHeight);

        $timeText =
            date('g:iA', strtotime($timeSlot->start_time))
            . ' - '
            . date('g:iA', strtotime($timeSlot->end_time));

        $table->addCell(1750, [
            'valign' => 'center',
        ])->addText(
            $timeText,
            [
                'name' => 'Times New Roman',
                'size' => 9,
                'bold' => true,
            ],
            $centerParagraph
        );

        foreach ($days as $dayName) {
            $daySchedule = $schedules
                ->where('day_of_week', $dayName)
                ->where('slot_id', $timeSlot->id)
                ->first();

            $cell = $table->addCell(2810, [
                'valign' => 'center',
            ]);

            if (!$daySchedule) {
                $cell->addText(
                    '—',
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'color' => '808080',
                    ],
                    $centerParagraph
                );

                continue;
            }

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
                    ],
                    $centerParagraph
                );

                if (!empty($daySchedule->special_note)) {
                    $cell->addText(
                        $daySchedule->special_note,
                        [
                            'name' => 'Times New Roman',
                            'size' => 10,
                        ],
                        $centerParagraph
                    );
                }

                continue;
            }

            $courseName =
                $daySchedule->course?->course_name
                ?? $daySchedule->course?->name
                ?? '';

            $cell->addText(
                $courseName,
                [
                    'name' => 'Times New Roman',
                    'size' => 10,
                    'bold' => true,
                ],
                $centerParagraph
            );

            if ($daySchedule->professor?->name) {
                $cell->addText(
                    'Prof. ' . $daySchedule->professor->name,
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                    ],
                    $centerParagraph
                );
            }

            /*
            |--------------------------------------------------------------------------
            | COMBINED YEAR
            |--------------------------------------------------------------------------
            */

            $combinedYears = $daySchedule->scheduleDepartments
                ->where('department_id', (int) $departmentId)
                ->pluck('year_level')
                ->map(fn ($level) => (int) $level)
                ->filter(fn ($level) => $level !== $yearLevel)
                ->unique()
                ->sort()
                ->values();

            if ($combinedYears->isNotEmpty()) {
                $romanYears = $combinedYears->map(
                    function ($level) {
                        return match ($level) {
                            1 => 'I',
                            2 => 'II',
                            3 => 'III',
                            4 => 'IV',
                            default => (string) $level,
                        };
                    }
                );

                $cell->addText(
                    'Combine Year ' . $romanYears->implode(', '),
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                        'color' => 'FF0000',
                    ],
                    $centerParagraph
                );
            }

            /*
            |--------------------------------------------------------------------------
            | TEACHING MODE
            |--------------------------------------------------------------------------
            */

            $cell->addText(
                ucfirst($daySchedule->teaching_mode ?? 'offline'),
                [
                    'name' => 'Times New Roman',
                    'size' => 10,
                ],
                $centerParagraph
            );

            if ($daySchedule->room?->room_name) {
                $cell->addText(
                    'Room : ' . $daySchedule->room->room_name,
                    [
                        'name' => 'Times New Roman',
                        'size' => 10,
                    ],
                    $centerParagraph
                );
            }
        }
    }

    $section->addTextBreak(1);

    /*
    |--------------------------------------------------------------------------
    | DATES / EXAMS
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

    $leftInfo = $dateTable->addCell(7900, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'top',
    ]);

    $leftInfo->addText(
        'Starting Date: ' .
            (
                $selectedSchedule->starting_date
                    ? date('d/m/Y', strtotime($selectedSchedule->starting_date))
                    : ''
            ),
        $normalFont,
        $leftParagraph
    );

    $leftInfo->addText(
        'Finished Date: ' .
            (
                $selectedSchedule->finished_date
                    ? date('d/m/Y', strtotime($selectedSchedule->finished_date))
                    : ''
            ),
        $normalFont,
        $leftParagraph
    );

    $rightInfo = $dateTable->addCell(7900, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'top',
    ]);

    $rightInfo->addText(
        'Mid-Term Exam: ' .
            (
                $selectedSchedule->midterm_exam_start
                    ? date('d/m/Y', strtotime($selectedSchedule->midterm_exam_start))
                    : ''
            ),
        $normalFont,
        $leftParagraph
    );

    $rightInfo->addText(
        'Final Exam: ' .
            (
                $selectedSchedule->final_exam_start
                    ? date('d/m/Y', strtotime($selectedSchedule->final_exam_start))
                    : ''
            ),
        $normalFont,
        $leftParagraph
    );

    $section->addTextBreak(1);

    /*
    |--------------------------------------------------------------------------
    | NOTE
    |--------------------------------------------------------------------------
    */

    $section->addText(
        'Note: Professors/Lecturers are asked to give the final exam in softcopy to Academic office at least 2 weeks before the final examination',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
        ],
        $leftParagraph
    );

    if (!empty($selectedSchedule->note)) {
        $section->addText(
            'Additional Note: ' . $selectedSchedule->note,
            [
                'name' => 'Times New Roman',
                'size' => 10,
                'bold' => true,
            ],
            $leftParagraph
        );
    }

    $section->addTextBreak(1);



/*
|--------------------------------------------------------------------------
| APPROVAL
|--------------------------------------------------------------------------
*/

$section->addTextBreak(1);

$approvalDate = $selectedSchedule->created_at
    ? $selectedSchedule->created_at->format('d/m/Y')
    : now()->format('d/m/Y');

$approvalTable = $section->addTable([
    'alignment' => JcTable::CENTER,
    'borderSize' => 0,
    'borderColor' => 'FFFFFF',
    'cellMargin' => 0,
    'width' => 15800,
    'layout' => 'fixed',
]);

$approvalTable->addRow(450);

/*
|--------------------------------------------------------------------------
| YEAR 1 APPROVAL
|--------------------------------------------------------------------------
*/

if ($yearLevel === 1) {

    $approvalCell = $approvalTable->addCell(15800, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'top',
    ]);

    $approvalCell->addText(
        'Date: ' . $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    $approvalCell->addText(
        'HEAD OF FOUNDATION YEAR DEPARTMENT',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    // 3 enters under the department head
    $approvalCell->addTextBreak(2);

    $approvalCell->addText(
        'SOEUNG SAMBATH',
        [
            'name' => 'Times New Roman',
            'size' => 11,
            'bold' => true,
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
| YEAR 2, YEAR 3, YEAR 4 APPROVAL
|--------------------------------------------------------------------------
*/

} else {

    $leftApproval = $approvalTable->addCell(7900, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'top',
    ]);

    $leftApproval->addText(
        'Date: ' . $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    $leftApproval->addText(
        'HEAD OF ACADEMIC OFFICE',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    // 3 enters under Academic Office
    $leftApproval->addTextBreak(2);

    $leftApproval->addText(
        'LEC. SAN PISETH',
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
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
    | RIGHT APPROVAL - DEPARTMENT HEAD
    |--------------------------------------------------------------------------
    */

    $rightApproval = $approvalTable->addCell(7900, [
        'borderSize' => 0,
        'borderColor' => 'FFFFFF',
        'valign' => 'top',
    ]);

    $rightApproval->addText(
        'Date: ' . $approvalDate,
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    $rightApproval->addText(
        'HEAD OF ' . strtoupper($department->department_name),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => true,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );

    // 3 enters under the department head
    $rightApproval->addTextBreak(2);

    $rightApproval->addText(
        'LEC. ' . strtoupper(
            $department->head?->name
                ?? 'DEPARTMENT HEAD NOT ASSIGNED'
        ),
        [
            'name' => 'Times New Roman',
            'size' => 10,
            'bold' => false,
        ],
        [
            'alignment' => Jc::LEFT,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'lineHeight' => 1.0,
        ]
    );
}

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD
    |--------------------------------------------------------------------------
    */

    $safeDepartment = preg_replace(
        '/[^A-Za-z0-9_-]+/',
        '_',
        $department->department_name
    );

    $filename =
        'Class_Schedule_Year_' . $yearLevel
        . '_' . $safeDepartment
        . '_' . str_replace(
            '-',
            '_',
            $selectedSchedule->academic_year
        )
        . '.docx';

    $writer = IOFactory::createWriter($phpWord, 'Word2007');

    $tempFile = tempnam(
        sys_get_temp_dir(),
        'student_schedule_'
    );

    $writer->save($tempFile);

    return response()
        ->download($tempFile, $filename)
        ->deleteFileAfterSend(true);
}

}