<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; //view all tasks to auth users
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return true; //view single task to auth users
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //dd($user->is_admin);// Only admins can create (dd($user->is_admin));
        return $user->is_admin;// Only admins can create
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->is_admin;// Only admins can update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->is_admin;// Only admins can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->is_admin;// Only admins can restore
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->is_admin;// Only admins can force delete
    }
}
