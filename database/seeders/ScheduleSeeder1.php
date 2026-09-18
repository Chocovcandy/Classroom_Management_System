<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\ScheduleDepartment;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\Department;
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
            | BASIC DATA
            |--------------------------------------------------------------------------
            */

            $department = Department::first();

            if (!$department) {
                throw new \RuntimeException(
                    'No department found. Run your department seeder first.'
                );
            }

            $courses = Course::where('department_id', $department->id)
                ->orderBy('id')
                ->take(4)
                ->get();

            if ($courses->count() < 3) {
                throw new \RuntimeException(
                    'At least 3 courses are needed for this schedule seeder.'
                );
            }

            $professors = $department->users()
                ->whereHas('roles', function ($query) {
                    $query->where('role_name', 'Professor');
                })
                ->orderBy('id')
                ->get();

            if ($professors->isEmpty()) {
                throw new \RuntimeException(
                    'No Professor found in the selected department.'
                );
            }

            $classrooms = Classroom::orderBy('id')
                ->take(4)
                ->get();

            if ($classrooms->isEmpty()) {
                throw new \RuntimeException(
                    'No classroom found. Run your classroom seeder first.'
                );
            }

            $timeSlots = TimeSlot::orderBy('session_number')
                ->take(4)
                ->get();

            if ($timeSlots->count() < 4) {
                throw new \RuntimeException(
                    'At least 4 time slots are needed.'
                );
            }

            $createdBy = User::whereHas('roles', function ($query) {
                $query->whereIn('role_name', ['Admin', 'HoD']);
            })->first();

            if (!$createdBy) {
                $createdBy = User::first();
            }

            if (!$createdBy) {
                throw new \RuntimeException(
                    'No user found for created_by.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | SCHEDULE INFORMATION
            |--------------------------------------------------------------------------
            */

            $semester = 'Semester 1';
            $academicYear = '2026-2027';
            $promotion = 3;
            $mainYear = 3;

            $startingDate = '2026-09-13';
            $finishedDate = '2026-12-13';

            $midtermStart = '2026-09-26';
            $midtermEnd = '2026-09-30';

            $finalStart = '2026-11-18';
            $finalEnd = '2026-11-23';

            $note = 'Professors/Lecturers are asked to give the final exam in softcopy to Academic office at least 2 weeks before the final examination';

            /*
            |--------------------------------------------------------------------------
            | ONE WEEKLY GROUP
            |--------------------------------------------------------------------------
            */

            $scheduleGroupId = (string) Str::uuid();

            $days = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ];

            /*
            |--------------------------------------------------------------------------
            | CREATE MONDAY - FRIDAY
            |--------------------------------------------------------------------------
            */

            foreach ($days as $dayIndex => $day) {

                foreach ($timeSlots as $slotIndex => $timeSlot) {

                    /*
                    |--------------------------------------------------------------------------
                    | SESSION 3 = CHAPEL
                    |--------------------------------------------------------------------------
                    */

                    if ((int) $timeSlot->session_number === 3) {

                        $schedule = Schedule::updateOrCreate(
                            [
                                'day_of_week' => $day,
                                'slot_id' => $timeSlot->id,
                                'semester' => $semester,
                                'academic_year' => $academicYear,
                                'promotion' => $promotion,
                            ],
                            [
                                'schedule_group_id' => $scheduleGroupId,

                                'activity_type' => 'chapel',
                                'special_note' => 'Morning Chapel',

                                'course_id' => null,
                                'professor_id' => null,
                                'room_id' => null,

                                'starting_date' => $startingDate,
                                'finished_date' => $finishedDate,

                                'midterm_exam_start' => $midtermStart,
                                'midterm_exam_end' => $midtermEnd,

                                'final_exam_start' => $finalStart,
                                'final_exam_end' => $finalEnd,

                                'status' => 'draft',
                                'created_by' => $createdBy->id,
                                'approved_by' => null,
                                'note' => $note,
                            ]
                        );

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | NORMAL COURSE SESSION
                        |--------------------------------------------------------------------------
                        */

                        $course = $courses[$slotIndex % $courses->count()];
                        $professor = $professors[$slotIndex % $professors->count()];
                        $classroom = $classrooms[$slotIndex % $classrooms->count()];

                        $schedule = Schedule::updateOrCreate(
                            [
                                'day_of_week' => $day,
                                'slot_id' => $timeSlot->id,
                                'semester' => $semester,
                                'academic_year' => $academicYear,
                                'promotion' => $promotion,
                            ],
                            [
                                'schedule_group_id' => $scheduleGroupId,

                                'activity_type' => 'course',
                                'special_note' => null,

                                'course_id' => $course->id,
                                'professor_id' => $professor->id,
                                'room_id' => $classroom->id,

                                'starting_date' => $startingDate,
                                'finished_date' => $finishedDate,

                                'midterm_exam_start' => $midtermStart,
                                'midterm_exam_end' => $midtermEnd,

                                'final_exam_start' => $finalStart,
                                'final_exam_end' => $finalEnd,

                                'status' => 'draft',
                                'created_by' => $createdBy->id,
                                'approved_by' => null,
                                'note' => $note,
                            ]
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | MAIN YEAR
                    |--------------------------------------------------------------------------
                    */

                    ScheduleDepartment::updateOrCreate(
                        [
                            'schedule_id' => $schedule->id,
                            'department_id' => $department->id,
                            'year_level' => $mainYear,
                        ],
                        []
                    );
                }
            }

            $this->command?->info(
                "Schedule seeded successfully for {$academicYear}, Promotion {$promotion}, Year {$mainYear}."
            );

            $this->command?->info(
                "Session 3 on Monday-Friday is saved as Chapel."
            );
        });
    }
}
