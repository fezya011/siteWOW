<?php
// app/Http/Controllers/Api/ProfileController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Показать профиль пользователя.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load('posts');

        return response()->json([
            'user' => new UserResource($user),
            'stats' => [
                'posts_count' => $user->posts()->count(),
                'comments_count' => 0, // Будет реализовано позже
                'photos_count' => 0, // Будет реализовано позже
            ],
            'latest_posts' => $user->posts()->latest()->take(6)->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'created_at' => $post->created_at->toISOString(),
                ];
            }),
        ]);
    }

    /**
     * Обновить профиль пользователя.
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => new UserResource($user),
        ]);
    }
}
