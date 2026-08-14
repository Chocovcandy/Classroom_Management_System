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
        // Get department from the database to assign to users
            $cs = Department::where('department_name', 'Computer Science')->first();
        $english = Department::where('department_name', 'English')->first();
        $management = Department::where('department_name', 'Management')->first();  
        // Create users
        $seed1 = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),

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
            // 'profile_image' => 'images/profile_images/pich.jpg', // Assuming you have a profile image for pich 
        ]);
        // assign Dean role to the second user
         $seed2->roles()->attach(
            Role::where('role_name', 'Dean')->value('id') // Assuming 2 is Dean
        );

        // Dean can manage multiple departments
        $seed2->departments()->sync([
            $cs->id,
            $english->id,
            $management->id
        ]);


        // theary has 2 roles, HoD and Professor
        $seed3 = User::create([
            'name' => 'theary',
            'email' => 'theary@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        // same with the third user, assign both HoD and Professor roles
            $seed3->roles()->attach([
                Role::where('role_name', 'HoD')->value('id'), // Assuming 3 is HoD
                Role::where('role_name', 'Professor')->value('id') // Assuming 4 is Professor
            ]);

        // assign theary to Computer Science department as HoD
        $seed3->departments()->sync([$cs->id]);    

        // IMPORTANT: set HoD as department head
        $cs->head_id = $seed3->id;
        $cs->save();


        // chy has 1 role, Professor
         $seed4 = User::create([
            'name' => 'chy',
            'email' => 'chy@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        // assign Professor role to the fourth user
         $seed4->roles()->attach(
            Role::where('role_name', 'Professor')->value('id')
        );

        // Professor belongs to one department
        $seed4->departments()->sync([$english->id]);
    


        // meii has 1 role, Student
        $seed5 = User::create([
            'name' => 'meii',
            'email' => 'meii@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        //same same with the fifth user, assign both Student role
            $seed5->roles()->attach(
                Role::where('role_name', 'Student')->value('id')
            );

        // Student belongs to one department
        $seed5->departments()->sync([$english->id]);    

        //note: this is the  id each role in the roles table after seeding the RoleSeeder to the database
        // role_id = 2 for Dean
        // role_id = 3 for HoD
        // role_id = 4 for Professor
        // role_id = 5 for Student
    }
}