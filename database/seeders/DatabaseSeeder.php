<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Project;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,

            ClassroomSeeder::class,
            TimeSlotSeeder::class,

            ClassGroupSeeder::class,
            ClassMemberSeeder::class,
                TopicSeeder::class,
    MaterialSeeder::class,
    AssignmentSeeder::class,
    QuizSeeder::class,
    ExamSeeder::class,
  ProjectSeeder::class,
  ProjectGroupSeeder::class,
  ProjectGroupMemberSeeder::class,
      ScheduleSeeder::class,
        ]);
    }
}