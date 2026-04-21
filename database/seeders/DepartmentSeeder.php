<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['department_name' => 'Computer Science', 'description' => 'CS Department']);
        Department::create(['department_name' => 'English', 'description' => 'English Department']);
        Department::create(['department_name' => 'Management', 'description' => 'Management Department']);
    }
}
