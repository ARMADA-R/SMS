<?php

namespace App\Policies;

use App\Models\Season;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SeasonPolicy
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
        return $user->hasPermission('browse-seasons')
            ? Response::allow()
            : Response::deny('You do not have permission to browse seasons.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermission('view-seasons')
            ? Response::allow()
            : Response::deny('You do not have permission to access Season details.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('add-seasons')
            ? Response::allow()
            : Response::deny('You do not have permission to add new seasons.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermission('edit-seasons')
            ? Response::allow()
            : Response::deny('You do not have permission to edit seasons.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermission('delete-seasons')
            ? Response::allow()
            : Response::deny('You do not have permission to delete seasons.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Season  $season
     * @return mixed
     */
    public function restore(User $user, Season $season)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Season  $season
     * @return mixed
     */
    public function forceDelete(User $user, Season $season)
    {
        //
    }
}
