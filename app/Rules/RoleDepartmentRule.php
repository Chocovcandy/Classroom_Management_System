<?php

namespace App\Rules;

class RoleDepartmentRule
{
    public static function type(string $roleName): string
    {
        return match ($roleName) {
            'Dean' => 'many',
            'HoD' => 'one',
            'Professor' => 'many',
            'Student' => 'one',
            default => 'none',
        };
    }
}


//// not confirmed to use yet - this is a helper class to determine the type of department assignment based on role.