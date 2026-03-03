<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin',       fn(User $user) => $user->role == 'admin');
        Gate::define('create-post', fn(User $user) => true);
        Gate::define('update-post', fn(User $user, Post $post) => $user->role === 'admin' || (int) $post->user_id === $user->id);
        Gate::define('delete-post', fn(User $user, Post $post) => $user->role == 'admin' || $post->user_id == $user->id);
    }
}
