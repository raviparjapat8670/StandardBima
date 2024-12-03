<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function list(User $user): bool
    {
        // Check if the user has permission to 'list' on the 'User' module
        return checkUserPermission($user, 'users', 'list');
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Check if the user has permission to 'create' on the 'User' module
        return checkUserPermission($user, 'users', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user): bool
    {
        // Check if the user has permission to 'edit' on the 'User' module
        return checkUserPermission($user, 'users', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        // Check if the user has permission to 'edit' on the 'User' module
        return checkUserPermission($user, 'users', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
