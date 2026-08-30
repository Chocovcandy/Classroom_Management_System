<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $computerScience = Department::where(
            'department_name',
            'Computer Science'
        )->first();

        if (!$computerScience) {
            return;
        }
        // course 1
        Course::create([
            'course_name' => 'Web Development',
            'course_code' => 'CS301',
            'department_id' => $computerScience->id,
            'description' => 'Introduction to modern web development.',
            'credits' => 3,
        ]);


        //course 2
        Course::create([
            'course_name' => 'Database Management',
            'course_code' => 'CS302',
            'department_id' => $computerScience->id,
            'description' => 'Fundamentals of database design and management.',
            'credits' => 3,
        ]);

        // course 3
        Course::create([
            'course_name' => 'Software Engineering',
            'course_code' => 'CS303',
            'department_id' => $computerScience->id,
            'description' => 'Software engineering principles and development practices.',
            'credits' => 3,
        ]);
    }
}