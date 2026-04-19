<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['role_name' => 'Admin']);
        Role::create(['role_name' => 'Dean']);
        Role::create(['role_name' => 'HoD']);
        Role::create(['role_name' => 'Lecturer']);
        Role::create(['role_name' => 'Student']);
    }
}