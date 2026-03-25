<?php
// app/Policies/PostPolicy.php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine if the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * Determine if the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * Determine if the user can create a post.
     */
    public function create(User $user): bool
    {
        return true; // Все авторизованные пользователи могут создавать посты
    }
}
