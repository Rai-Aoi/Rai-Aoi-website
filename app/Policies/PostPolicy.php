<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    public function viewForAdmin(User $user)
    {
        return $user->isAdmin();
    }

    public function viewForStaff(User $user)
    {
        return $user->isStaff();
    }

    public function viewForManager(User $user)
    {
        return $user->isManager();
    }

    public function viewForStudentAffair(User $user)
    {
        return $user->isStudentAffair();
    }

    public function viewForUser(User $user)
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin() or $user->isStudentAffair() or $user->isUser();
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        $process_id = $post->processes->pluck('id')->all();
        $process_id = implode(", ", $process_id);

        if($process_id == 1 or $process_id == 2){
            return $user->isAdmin() or $user->isStudentAffair() or
            ($user->isUser() and $user->id === $post->user_id);
        }
        else{
            return $user->isAdmin() or $user->isStaff() or $user->isStudentAffair() or
            ($user->isUser() and $user->id === $post->user_id);
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Post $post)
    {
        return $user->isAdmin() or $user->isStudentAffair() or $user->isUser();
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Post $post)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->isAdmin();
    }
}
