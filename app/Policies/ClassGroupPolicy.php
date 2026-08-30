<?php

namespace App\Policies;

use App\Models\ClassGroup;
use App\Models\User;

class ClassGroupPolicy
{
    /**
     * Determine whether the user can view this class group.
     *
     * A professor can view a class group only if
     * they are the professor assigned to that class group.
     */
    public function view(User $user, ClassGroup $classGroup): bool
    {
        return $classGroup->professor_id === $user->id;
    }

    /**
     * Determine whether the user can create a class group.
     *
     * The Professor role middleware should already protect
     * the route, so this method is optional.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Professor');
    }

    /**
     * Determine whether the user can update this class group.
     *
     * Only the professor assigned to the class group
     * can update it.
     */
    public function update(User $user, ClassGroup $classGroup): bool
    {
        return $classGroup->professor_id === $user->id;
    }

    /**
     * Determine whether the user can delete this class group.
     *
     * Only the professor assigned to the class group
     * can delete it.
     */
    public function delete(User $user, ClassGroup $classGroup): bool
    {
        return $classGroup->professor_id === $user->id;
    }

    /**
     * Determine whether the user can manage this class group.
     *
     * This is useful for Professor classroom operations such as:
     *
     * - Uploading materials
     * - Creating assignments
     * - Creating announcements
     * - Updating classroom information
     * - Deleting classroom content
     *
     * Keeping this check here prevents the same
     * professor_id check from being repeated in
     * multiple controllers.
     */
    public function manage(User $user, ClassGroup $classGroup): bool
    {
        return $classGroup->professor_id === $user->id;
    }
}