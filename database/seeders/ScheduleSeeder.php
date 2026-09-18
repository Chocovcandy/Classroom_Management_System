<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\ScheduleDepartment;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | FIND COMPUTER SCIENCE DEPARTMENT
            |--------------------------------------------------------------------------
            */

            $department = Department::where(
                'department_name',
                'Computer Science'
            )->first();

            if (!$department) {
                $this->command->error(
                    'Computer Science department not found.'
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | MANUALLY SELECT PROFESSORS
            |--------------------------------------------------------------------------
            */

            $pich = User::where(
                'email',
                'pich@lifeun.edu.kh'
            )->firstOrFail();

            $theary = User::where(
                'email',
                'theary@lifeun.edu.kh'
            )->firstOrFail();

            $chy = User::where(
                'email',
                'chy@lifeun.edu.kh'
            )->firstOrFail();

            $andy = User::where(
                'email',
                'andy@lifeun.edu.kh'
            )->firstOrFail();

            $chaya = User::where(
                'email',
                'chaya@lifeun.edu.kh'
            )->firstOrFail();

            $sitha = User::where(
                'email',
                'sitha@lifeun.edu.kh'
            )->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | FIND COURSES
            |--------------------------------------------------------------------------
            */

            $courses = Course::where(
                'department_id',
                $department->id
            )
                ->whereIn(
                    'course_code',
                    [
                        'CS301',
                        'CS302',
                        'CS303',
                    ]
                )
                ->get()
                ->keyBy('course_code');

            foreach ([
                'CS301',
                'CS302',
                'CS303',
            ] as $courseCode) {

                if (!$courses->has($courseCode)) {
                    $this->command->error(
                        "Course {$courseCode} not found."
                    );

                    return;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | FIND CLASSROOMS
            |--------------------------------------------------------------------------
            */

            $roomNames = [
                '315',
                '316',
                '317',
                '318',
                '409',
                '410',
                '413',
                '414',
                '415',
                '416',
                '417',
                '418',
                'B01',
                'B02',
                'B03',
                'B04',
                'B05',
                'B06',
                'B07',
                'Computer Lab 1',
            ];

            $rooms = Classroom::whereIn(
                'room_name',
                $roomNames
            )
                ->get()
                ->keyBy('room_name');

            foreach ($roomNames as $roomName) {

                if (!$rooms->has($roomName)) {
                    $this->command->error(
                        "Classroom {$roomName} not found."
                    );

                    return;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | FIND TIME SLOTS
            |--------------------------------------------------------------------------
            */

            $slots = TimeSlot::orderBy(
                'session_number'
            )
                ->take(4)
                ->get()
                ->keyBy('session_number');

            if ($slots->count() < 4) {
                $this->command->error(
                    'Four time slots are required.'
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | WEEK INFORMATION
            |--------------------------------------------------------------------------
            */

            $mainYear = 4;

            $semester = 'Semester 1';

            $academicYear = '2026-2027';

            $promotion = 1;

            $startingDate = '2026-09-01';

            $finishedDate = '2027-01-15';

            $midtermExamStart = '2026-10-19';

            $midtermExamEnd = '2026-10-23';

            $finalExamStart = '2026-12-14';

            $finalExamEnd = '2026-12-18';

            /*
            |--------------------------------------------------------------------------
            | DO NOT CREATE THE SAME WEEK TWICE
            |--------------------------------------------------------------------------
            */

            $existingSchedule = Schedule::where(
                'semester',
                $semester
            )
                ->where(
                    'academic_year',
                    $academicYear
                )
                ->where(
                    'promotion',
                    $promotion
                )
                ->whereHas(
                    'scheduleDepartments',
                    function ($query) use (
                        $department,
                        $mainYear
                    ) {
                        $query
                            ->where(
                                'department_id',
                                $department->id
                            )
                            ->where(
                                'year_level',
                                $mainYear
                            )
                            ->whereRaw(
                                'schedule_departments.id = (
                                    SELECT MIN(sd2.id)
                                    FROM schedule_departments AS sd2
                                    WHERE sd2.schedule_id = schedule_departments.schedule_id
                                      AND sd2.department_id = ?
                                )',
                                [$department->id]
                            );
                    }
                )
                ->exists();

            if ($existingSchedule) {

                $this->command->info(
                    'Year 4 weekly schedule already exists. Skipping.'
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | ONE GROUP ID FOR THE WHOLE WEEK
            |--------------------------------------------------------------------------
            */

            $scheduleGroupId = (string) Str::uuid();

            /*
            |--------------------------------------------------------------------------
            | FULL WEEK
            |--------------------------------------------------------------------------
            |
            | 5 days × 4 sessions = 20 sessions
            |
            | Main year = Year 4
            |
            | Combined Year 2 is used only on selected sessions.
            |
            */

            $sessions = [

                /*
                |--------------------------------------------------------------------------
                | MONDAY
                |--------------------------------------------------------------------------
                */

                [
                    'day' => 'Monday',
                    'slot' => 1,
                    'course' => 'CS301',
                    'professor' => $pich,
                    'room' => '315',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Monday',
                    'slot' => 2,
                    'course' => 'CS302',
                    'professor' => $theary,
                    'room' => '316',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Monday',
                    'slot' => 3,
                    'course' => 'CS303',
                    'professor' => $chy,
                    'room' => '317',
                    'combined_years' => [2],
                ],

                [
                    'day' => 'Monday',
                    'slot' => 4,
                    'course' => 'CS301',
                    'professor' => $andy,
                    'room' => '318',
                    'combined_years' => [],
                ],

                /*
                |--------------------------------------------------------------------------
                | TUESDAY
                |--------------------------------------------------------------------------
                */

                [
                    'day' => 'Tuesday',
                    'slot' => 1,
                    'course' => 'CS302',
                    'professor' => $chaya,
                    'room' => '409',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Tuesday',
                    'slot' => 2,
                    'course' => 'CS303',
                    'professor' => $sitha,
                    'room' => '410',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Tuesday',
                    'slot' => 3,
                    'course' => 'CS301',
                    'professor' => $pich,
                    'room' => '413',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Tuesday',
                    'slot' => 4,
                    'course' => 'CS302',
                    'professor' => $theary,
                    'room' => '414',
                    'combined_years' => [],
                ],

                /*
                |--------------------------------------------------------------------------
                | WEDNESDAY
                |--------------------------------------------------------------------------
                */

                [
                    'day' => 'Wednesday',
                    'slot' => 1,
                    'course' => 'CS303',
                    'professor' => $chy,
                    'room' => '415',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Wednesday',
                    'slot' => 2,
                    'course' => 'CS301',
                    'professor' => $andy,
                    'room' => '416',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Wednesday',
                    'slot' => 3,
                    'course' => 'CS302',
                    'professor' => $chaya,
                    'room' => '417',
                    'combined_years' => [2],
                ],

                [
                    'day' => 'Wednesday',
                    'slot' => 4,
                    'course' => 'CS303',
                    'professor' => $sitha,
                    'room' => '418',
                    'combined_years' => [],
                ],

                /*
                |--------------------------------------------------------------------------
                | THURSDAY
                |--------------------------------------------------------------------------
                */

                [
                    'day' => 'Thursday',
                    'slot' => 1,
                    'course' => 'CS301',
                    'professor' => $pich,
                    'room' => 'B01',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Thursday',
                    'slot' => 2,
                    'course' => 'CS302',
                    'professor' => $theary,
                    'room' => 'B02',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Thursday',
                    'slot' => 3,
                    'course' => 'CS303',
                    'professor' => $chy,
                    'room' => 'B03',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Thursday',
                    'slot' => 4,
                    'course' => 'CS301',
                    'professor' => $andy,
                    'room' => 'B04',
                    'combined_years' => [],
                ],

                /*
                |--------------------------------------------------------------------------
                | FRIDAY
                |--------------------------------------------------------------------------
                */

                [
                    'day' => 'Friday',
                    'slot' => 1,
                    'course' => 'CS302',
                    'professor' => $chaya,
                    'room' => 'B05',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Friday',
                    'slot' => 2,
                    'course' => 'CS303',
                    'professor' => $sitha,
                    'room' => 'B06',
                    'combined_years' => [],
                ],

                [
                    'day' => 'Friday',
                    'slot' => 3,
                    'course' => 'CS301',
                    'professor' => $pich,
                    'room' => 'B07',
                    'combined_years' => [2],
                ],

                [
                    'day' => 'Friday',
                    'slot' => 4,
                    'course' => 'CS302',
                    'professor' => $theary,
                    'room' => 'Computer Lab 1',
                    'combined_years' => [],
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | CREATE ALL SESSIONS
            |--------------------------------------------------------------------------
            */

            foreach ($sessions as $session) {

                $course = $courses->get(
                    $session['course']
                );

                $room = $rooms->get(
                    $session['room']
                );

                $timeSlot = $slots->get(
                    $session['slot']
                );

                /*
                |--------------------------------------------------------------------------
                | MAIN YEAR FIRST
                |--------------------------------------------------------------------------
                */

                $yearLevels = array_values(
                    array_unique([
                        $mainYear,
                        ...$session['combined_years'],
                    ])
                );

                /*
                |--------------------------------------------------------------------------
                | CREATE SCHEDULE
                |--------------------------------------------------------------------------
                */

                $schedule = Schedule::create([

                    'schedule_group_id' => $scheduleGroupId,

                    'activity_type' => 'course',

                    'special_note' => null,

                    'course_id' => $course->id,

                    'professor_id' => $session['professor']->id,

                    'room_id' => $room->id,

                    'day_of_week' => $session['day'],

                    'slot_id' => $timeSlot->id,

                    'semester' => $semester,

                    'academic_year' => $academicYear,

                    'promotion' => $promotion,

                    'teaching_mode' => 'offline',

                    'starting_date' => $startingDate,

                    'finished_date' => $finishedDate,

                    'midterm_exam_start' => $midtermExamStart,

                    'midterm_exam_end' => $midtermExamEnd,

                    'final_exam_start' => $finalExamStart,

                    'final_exam_end' => $finalExamEnd,

                    'status' => 'draft',

                    'created_by' => $pich->id,

                    'approved_by' => null,

                    'note' => 'Seeded Year 4 weekly schedule.',
                ]);

                /*
                |--------------------------------------------------------------------------
                | SAVE YEAR LEVELS
                |--------------------------------------------------------------------------
                |
                | IMPORTANT:
                | Main Year 4 is inserted FIRST.
                | Combined years are inserted AFTER it.
                |
                */

                foreach ($yearLevels as $yearLevel) {

                    ScheduleDepartment::create([

                        'schedule_id' => $schedule->id,

                        'department_id' => $department->id,

                        'year_level' => $yearLevel,
                    ]);
                }
            }

            $this->command->info(
                'Full Monday-Friday Year 4 weekly schedule seeded successfully.'
            );
        });
    }
}