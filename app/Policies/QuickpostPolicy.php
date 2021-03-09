<?php

namespace App\Policies;

use App\Quickpost;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuickpostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quickpost  $quickpost
     * @return mixed
     */
    public function view(User $user, Quickpost $quickpost)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quickpost  $quickpost
     * @return mixed
     */
    public function update(User $user, Quickpost $quickpost)
    {
        if($quickpost->user_id == $user->id || $user->type == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quickpost  $quickpost
     * @return mixed
     */
    public function admin_update(User $user, Quickpost $quickpost)
    {
        if($user->type == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quickpost  $quickpost
     * @return mixed
     */
    public function delete(User $user, Quickpost $quickpost)
    {
        if($quickpost->user_id == $user->id || $user->type == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quickpost  $quickpost
     * @return mixed
     */
    public function admin_delete(User $user, Quickpost $quickpost)
    {
        if($user->type == 1){
            return true;
        }
    }
}
