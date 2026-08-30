<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;

class MaterialPolicy
{
    /**
     * Determine whether the user can view a specific material.
     *
     * Student:
     * - Must be enrolled in the classroom that owns the material.
     *
     * Professor:
     * - Must have access to the classroom that owns the material.
     *
     * This controls access to the material itself.
     */
    public function view(User $user, Material $material): bool
    {
        // TODO:
        // Check the user's relationship with
        // the material's ClassGroup.

        return true;
    }

    /**
     * Determine whether the user can create a material.
     *
     * Creating a material is normally controlled by
     * ClassGroupPolicy::manage().
     *
     * Therefore, this method may not be necessary
     * if your controller already authorizes the ClassGroup.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Professor');
    }

    /**
     * Determine whether the user can update a material.
     *
     * The important question is:
     *
     * "Can this professor manage the classroom
     * that this material belongs to?"
     *
     * This is better than simply checking user_id,
     * because another authorized professor could potentially
     * manage the same classroom.
     */
    public function update(User $user, Material $material): bool
    {
        // TODO:
        // Check whether the user can manage
        // the material's ClassGroup.

        return true;
    }

    /**
     * Determine whether the user can delete a material.
     *
     * Normally only a professor who can manage the
     * material's classroom should be able to delete it.
     */
    public function delete(User $user, Material $material): bool
    {
        // TODO:
        // Check whether the user can manage
        // the material's ClassGroup.

        return true;
    }

    /**
     * Determine whether the user can download a material.
     *
     * Student:
     * - Must be enrolled in the material's classroom.
     *
     * Professor:
     * - Must have access to the classroom.
     *
     * This is important because the download route is
     * a direct URL and must not rely on hiding a button.
     */
    public function download(User $user, Material $material): bool
    {
        // TODO:
        // Check classroom access.

        return true;
    }
}