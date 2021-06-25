<?php

namespace App\Policies;

use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpacePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Space  $space
     * @return mixed
     */
    public function view(?User $user, Space $space)
    {
        if ($space->visibility === 'public') {
            return true;
        }
        if ($space->visibility === 'private') {
            return $space->members->contains($user);
        }
        return false;
    }

    public function share(?User $user, Space $space)
    {
        return $space->visibility !== 'private';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Space  $space
     * @return mixed
     */
    public function update(User $user, Space $space)
    {
        return ($user->spaceRole($space) === 'owner') || ($user->spaceRole($space) === 'admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Space  $space
     * @return mixed
     */
    public function delete(User $user, Space $space)
    {
        return ($user->spaceRole($space) === 'owner');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Space  $space
     * @return mixed
     */
    public function restore(User $user, Space $space)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Space  $space
     * @return mixed
     */
    public function forceDelete(User $user, Space $space)
    {
        //
    }
}
