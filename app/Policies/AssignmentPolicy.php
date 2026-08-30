<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;

class AssignmentPolicy
{
    /**
     * Determine whether the user can view a specific assignment.
     *
     * Student:
     * - Must be enrolled in the assignment's classroom.
     *
     * Professor:
     * - Must have access to the classroom.
     */
    public function view(User $user, Assignment $assignment): bool
    {
        // TODO:
        // Check classroom access.

        return true;
    }

    /**
     * Determine whether the user can create an assignment.
     *
     * Creating an assignment is normally a Professor-only
     * classroom operation.
     *
     * The more specific classroom authorization can be
     * handled by ClassGroupPolicy::manage().
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Professor');
    }

    /**
     * Determine whether the user can update an assignment.
     *
     * The professor must be authorized to manage the
     * classroom that owns this assignment.
     */
    public function update(User $user, Assignment $assignment): bool
    {
        // TODO:
        // Check whether the user can manage
        // the assignment's ClassGroup.

        return true;
    }

    /**
     * Determine whether the user can delete an assignment.
     *
     * Only an authorized professor should be able to
     * delete an assignment from the classroom.
     */
    public function delete(User $user, Assignment $assignment): bool
    {
        // TODO:
        // Check classroom management permission.

        return true;
    }
}