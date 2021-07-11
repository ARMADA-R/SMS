<?php

namespace App\Policies;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class SettingsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('browse-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to browse settings.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settings  $settings
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermission('view-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to read settings details.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('add-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to add new settings.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settings  $settings
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermission('edit-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to edit settings.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settings  $settings
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermission('delete-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to delete settings.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settings  $settings
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->hasPermission('restore-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to restore settings.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settings  $settings
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->hasPermission('forceDelete-settings')
            ? Response::allow()
            : Response::deny('You do not have permission to forceDelete settings.');
    }
}
