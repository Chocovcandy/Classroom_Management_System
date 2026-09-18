<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Computer Science professor
        $professor = User::where('email', 'theary@lifeun.edu.kh')->first();

        if (!$professor) {
            return;
        }

        // Get the Computer Science courses
        $webDevelopment = Course::where(
            'course_code',
            'CS301'
        )->first();

        $database = Course::where(
            'course_code',
            'CS302'
        )->first();

        $softwareEngineering = Course::where(
            'course_code',
            'CS303'
        )->first();

        // Create Class Group for CS301
        if ($webDevelopment) {
            ClassGroup::create([
                'group_name' => 'Web Development A',
                'group_code' => 'WD-A-' . strtoupper(Str::random(6)),
                'professor_id' => $professor->id,
                'course_id' => $webDevelopment->id,
                'description' => 'Web Development class group.',
                'status' => 'active',
            ]);
        }

        // Create Class Group for CS302
        if ($database) {
            ClassGroup::create([
                'group_name' => 'Database Management A',
                'group_code' => 'DB-A-' . strtoupper(Str::random(6)),
                'professor_id' => $professor->id,
                'course_id' => $database->id,
                'description' => 'Database Management class group.',
                'status' => 'active',
            ]);
        }

        // Create Class Group for CS303
        if ($softwareEngineering) {
            ClassGroup::create([
                'group_name' => 'Software Engineering A',
                'group_code' => 'SE-A-' . strtoupper(Str::random(6)),
                'professor_id' => $professor->id,
                'course_id' => $softwareEngineering->id,
                'description' => 'Software Engineering class group.',
                'status' => 'active',
            ]);
        }
    }
}