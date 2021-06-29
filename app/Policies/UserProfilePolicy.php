<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user):bool
    {
        return $user->isSeller() ;
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\users  $users
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\users  $users
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\users  $users
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
