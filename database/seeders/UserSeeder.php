<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $csDept = Department::where('department_name', 'Computer Science')->first();
        $mathDept = Department::where('department_name', 'Mathematics')->first();

        // Create users
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'department_id' => $csDept->id
        ]);

        $hod = User::create([
            'name' => 'CS HoD',
            'email' => 'hod@example.com',
            'password' => bcrypt('password'),
            'department_id' => $csDept->id
        ]);

        $student = User::create([
            'name' => 'Student A',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'department_id' => $csDept->id
        ]);

        // Attach roles
        $admin->roles()->attach(Role::where('role_name', 'Admin')->first());
        $hod->roles()->attach(Role::where('role_name', 'HoD')->first());
        $student->roles()->attach(Role::where('role_name', 'Student')->first());

        // Optionally, set HoD as head of CS Department
        $csDept->head_id = $hod->id;
        $csDept->save();   
    }
}
