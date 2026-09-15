<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\TimeSlot;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use App\Models\User;

class ProfessorScheduleController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | GET ALL PUBLISHED SCHEDULES
        |--------------------------------------------------------------------------
        |
        | Do NOT filter by professor_id.
        | Professors should see the complete official schedule.
        |
        */

        $schedules = Schedule::with([
            'course',
            'professor',
            'room',
            'timeSlot',
        ])
            ->where('status', 'published')
            ->orderBy('academic_year')
            ->orderBy('semester')
            ->orderBy('promotion')
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
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TIME SLOTS
        |--------------------------------------------------------------------------
        */

        $timeSlots = TimeSlot::orderBy('session_number')->get();

        /*
        |--------------------------------------------------------------------------
        | GROUP PUBLISHED SCHEDULES
        |--------------------------------------------------------------------------
        |
        | One group represents one academic schedule combination:
        |
        | Academic Year + Semester + Promotion
        |
        */

        $scheduleGroups = $schedules
            ->groupBy(function ($schedule) {
                return implode('|', [
                    $schedule->academic_year,
                    $schedule->semester,
                    $schedule->promotion,
                ]);
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('professor.schedules.index', [
            'schedules' => $schedules,
            'timeSlots' => $timeSlots,
            'scheduleGroups' => $scheduleGroups,
        ]);
    }

    public function show(Schedule $schedule)
    {
        /*
        |--------------------------------------------------------------------------
        | ONLY SHOW PUBLISHED SCHEDULES
        |--------------------------------------------------------------------------
        */

        if ($schedule->status !== 'published') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | GET YEAR LEVEL
        |--------------------------------------------------------------------------
        */

        $year = $schedule->scheduleDepartments()
            ->orderBy('year_level')
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
        | GET COMPLETE PUBLISHED WEEK
        |--------------------------------------------------------------------------
        |
        | All Monday-Friday sessions created together share the same
        | schedule_group_id.
        |
        | Use that shared group ID so the Professor Details page shows
        | the exact weekly schedule created by the HoD.
        |
        | We do NOT filter by professor_id.
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
            ->where('status', 'published')
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

        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT
        |--------------------------------------------------------------------------
        |
        | The Show Blade uses the department for the approval section.
        |
        */

        $departmentId = $schedule->scheduleDepartments()
            ->value('department_id');

        $department = null;

        if ($departmentId) {
            $department = \App\Models\Department::with('head')
                ->find($departmentId);
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('professor.schedules.show', [
            'schedule' => $schedule,
            'schedules' => $schedules,
            'timeSlots' => $timeSlots,
            'year' => $year,
            'semesterText' => $semesterText,
            'department' => $department,
        ]);
    }

public function downloadDocx(Schedule $schedule)
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

}
