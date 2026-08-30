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
        // Get the student
        $student = User::where('email', 'meii@gmail.com')->first();

        if (!$student) {
            return;
        }

        // Get the Web Development class group
        $webDevelopmentGroup = ClassGroup::where(
            'group_name',
            'Web Development A'
        )->first();

        if ($webDevelopmentGroup) {
            $webDevelopmentGroup->students()->syncWithoutDetaching([
                $student->id
            ]);
        }
    }
}