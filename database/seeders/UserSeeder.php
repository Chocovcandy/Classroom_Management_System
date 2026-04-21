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
            $englishDept = Department::where('department_name', 'English')->first();    
            $managementDept = Department::where('department_name', 'Management')->first();
        // Create users
        $seed1 = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'department_id' => $csDept->id // Assign to CS department
        ]);

        // Assign Admin role to the first user
         $seed1->roles()->attach(
            Role::where('role_name', 'Admin')->value('id')
        );

        // pich has 1 role 
        $seed2 = User::create([
            'name' => 'pich',
            'email' => 'pich@gmail.com',
            'password' => bcrypt('12345678'),
            'department_id' => $csDept->id //Assign to CS department
        ]);
        // assign Dean role to the second user
         $seed2->roles()->attach(
            Role::where('role_name', 'Dean')->value('id') // Assuming 2 is Dean
        );


        // theary has 2 roles, HoD and Professor
        $seed3 = User::create([
            'name' => 'theary',
            'email' => 'theary@gmail.com',
            'password' => bcrypt('12345678'),
            'department_id' => $csDept->id // Assign to CS department
        ]);

        // same with the third user, assign both HoD and Professor roles
            $seed3->roles()->attach([
                Role::where('role_name', 'HoD')->value('id'), // Assuming 3 is HoD
                Role::where('role_name', 'Professor')->value('id') // Assuming 4 is Professor
            ]);

        // chy has 1 role, Professor
         $seed4 = User::create([
            'name' => 'chy',
            'email' => 'chy@gmail.com',
            'password' => bcrypt('12345678'),
            'department_id' => $csDept->id // Assign to CS department
        ]);
        // assign Professor role to the fourth user
         $seed4->roles()->attach(
            Role::where('role_name', 'Professor')->value('id')
        );

        // meii has 1 role, Student
        $seed5 = User::create([
            'name' => 'meii',
            'email' => 'meii@gmail.com',
            'password' => bcrypt('12345678'),
            'department_id' => $csDept->id
        ]);

        //same same with the fifth user, assign both Student role
            $seed5->roles()->attach(
                Role::where('role_name', 'Student')->value('id')
            );

        //note: this is the  id each role in the roles table after seeding the RoleSeeder to the database
        // role_id = 2 for Dean
        // role_id = 3 for HoD
        // role_id = 4 for Professor
        // role_id = 5 for Student

 

        // Set HoD as department head
        $csDept->update([
            'head_id' => $seed3->id, // seed3 is user that named theary and has HoD role, so we set theary as the head of CS department 
        ]);
    }
}
