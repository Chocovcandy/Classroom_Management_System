<?php

namespace App\Services;

use App\Models\User;
use App\Rules\RoleDepartmentRule;

class UserAssignmentService
{
    public function assignRoleAndDepartment(User $user, $role, $departmentIds = null)
    {
        $roleType = RoleDepartmentRule::type($role->role_name);

        // 1. attach role
        $user->roles()->sync([$role->id]);

        // 2. handle department logic
        switch ($roleType) {

            case 'many':
                // Dean, Professor, etc.
                $user->departments()->sync($departmentIds ?? []);
                break;

            case 'one':
                // HoD, Student, etc.
                $user->departments()->sync(
                    $departmentIds ? [$departmentIds[0]] : []
                );
                break;

            case 'none':
            default:
                $user->departments()->detach();
                break;
        }
    }
}