<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if($comment->user_id == $user->id || $user->id == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if($comment->user_id == $user->id || $user->id == 1){
            return true;
        }
    }
}
