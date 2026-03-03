<?php

namespace App\Service\PostsServices;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class CreatePostService
{
    public function execute(User $user, array $data): Post
    {
        return $user->posts()->create([
            ...$data,
            'author'          => $user->name,
            'author_initials' => $user->initials,
            'excerpt'         => $data['excerpt'] ?? Str::limit(strip_tags($data['content']), 150),
        ]);
    }
}
