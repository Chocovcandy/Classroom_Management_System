<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================================================
        // GET DEPARTMENTS
        // ============================================================

        $cs = Department::where(
            'department_name',
            'Computer Science'
        )->firstOrFail();

        $english = Department::where(
            'department_name',
            'English'
        )->firstOrFail();

        $management = Department::where(
            'department_name',
            'Management'
        )->firstOrFail();


        // ============================================================
        // GET ROLES
        // ============================================================

        $adminRole = Role::where(
            'role_name',
            'Admin'
        )->firstOrFail();

        $hodRole = Role::where(
            'role_name',
            'HoD'
        )->firstOrFail();

        $professorRole = Role::where(
            'role_name',
            'Professor'
        )->firstOrFail();

        $studentRole = Role::where(
            'role_name',
            'Student'
        )->firstOrFail();


        // ============================================================
        // HELPER: CREATE USER
        // ============================================================

        $createUser = function (
            string $name,
            string $email,
            Role $role,
            ?Department $department = null,
            array $additionalRoles = []
        ): User {

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('12345678'),
            ]);

            // Assign main role
            $user->roles()->attach($role->id);

            // Assign additional roles
            if (!empty($additionalRoles)) {
                $user->roles()->attach(
                    collect($additionalRoles)
                        ->map(fn ($role) => $role->id)
                        ->toArray()
                );
            }

            // Assign department
            if ($department) {
                $user->departments()->sync([
                    $department->id
                ]);
            }

            return $user;
        };


        // ============================================================
        // ADMIN
        // ============================================================

        $admin = $createUser(
            'Super Admin',
            'admin@lifeun.edu.kh',
            $adminRole
        );


        // ============================================================
        // PROFESSORS
        // ============================================================

        // Professor 1 - Pich
        $pich = $createUser(
            'Chhin Sreypich',
            'pich@lifeun.edu.kh',
            $professorRole,
            $cs
        );


        // Professor 2 - Chhin Chansotheary
        // Has both HoD and Professor roles
        $theary = $createUser(
            'Chhin Chansotheary',
            'theary@lifeun.edu.kh',
            $hodRole,
            $cs,
            [$professorRole]
        );

        // Set Computer Science HoD
        $cs->head_id = $theary->id;
        $cs->save();


        // Professor 3 - Phai Lychy
        $chy = $createUser(
            'Phai Lychy',
            'chy@lifeun.edu.kh',
            $professorRole,
            $cs
        );


        // Professor 4 - Andy Jung
        $andy = $createUser(
            'Andy Jung',
            'andy@lifeun.edu.kh',
            $professorRole,
            $cs
        );


        // Professor 5 - Chorn Sovanchaya
        $chaya = $createUser(
            'Chorn Sovanchaya',
            'chaya@lifeun.edu.kh',
            $professorRole,
            $english
        );


        // Professor 6 - Pho Sitha
        $sitha = $createUser(
            'Pho Sitha',
            'sitha@lifeun.edu.kh',
            $professorRole,
            $management
        );


        // ============================================================
        // STUDENTS
        // ============================================================

        // Student 1
        $meii = $createUser(
            'meii',
            'meii@lifeun.edu.kh',
            $studentRole,
            $english
        );


        // Student 2
        $student6 = $createUser(
            'student6',
            'student6@lifeun.edu.kh',
            $studentRole,
            $cs
        );


        // Student 3
        $student7 = $createUser(
            'student7',
            'student7@lifeun.edu.kh',
            $studentRole,
            $cs
        );


        // Student 4
        $student8 = $createUser(
            'student8',
            'student8@lifeun.edu.kh',
            $studentRole,
            $english
        );


        // Student 5
        $student9 = $createUser(
            'student9',
            'student9@lifeun.edu.kh',
            $studentRole,
            $management
        );


        // Student 6
        $student10 = $createUser(
            'student10',
            'student10@lifeun.edu.kh',
            $studentRole,
            $management
        );


        // Student 7
        $student11 = $createUser(
            'student11',
            'student11@lifeun.edu.kh',
            $studentRole,
            $cs
        );


        // Student 8
        $student12 = $createUser(
            'student12',
            'student12@lifeun.edu.kh',
            $studentRole,
            $english
        );


        // ============================================================
        // COMPLETE
        // ============================================================

        $this->command->info(
            'Users seeded successfully!'
        );

        $this->command->info(
            'Created 1 Admin, 6 Professors, and 8 Students.'
        );
    }
}