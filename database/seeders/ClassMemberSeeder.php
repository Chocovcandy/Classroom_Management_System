<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClassMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the students
        $students = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'Student');
        })->get();

        // Get all class groups
        $classGroups = ClassGroup::all();

        // Add all students to every class group
        foreach ($classGroups as $classGroup) {
            $classGroup->students()->syncWithoutDetaching(
                $students->pluck('id')->toArray()
            );
        }
    }
}
