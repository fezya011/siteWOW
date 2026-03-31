<?php
// app/Http/Controllers/Api/PostController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Posts\StorePostRequest;
use App\Http\Requests\Api\Posts\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Service\PostsServices\CreatePostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Показать посты с фильтрацией.
     *
     * @param Request $request
     * @return PostCollection
     */
    public function index(Request $request): PostCollection
    {
        $posts = Post::with('user')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->where('title', 'like', "%{$request->search}%")
                        ->orWhere('content', 'like', "%{$request->search}%")
                        ->orWhere('author', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('category') && $request->category !== 'all', function ($q) use ($request) {
                $q->where('category', $request->category);
            })
            ->when($request->get('sort', 'latest'), function ($q, $sort) {
                match ($sort) {
                    'popular' => $q->orderByDesc('likes'),
                    'oldest' => $q->orderBy('created_at'),
                    default => $q->orderByDesc('created_at'),
                };
            })
            ->paginate($request->get('per_page', 12));

        return new PostCollection($posts);
    }

    /**
     * Создать новый пост.
     *
     * @param StorePostRequest $request
     * @param CreatePostService $service
     * @return JsonResponse
     */
    public function store(StorePostRequest $request, CreatePostService $service): JsonResponse
    {
        $post = $service->execute($request->user(), $request->validated());
        $post->load('user');

        return response()->json([
            'message' => 'Post created successfully',
            'post' => new PostResource($post),
        ], 201);
    }

    /**
     * Показать конкретный пост.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        $post->load('user');

        return response()->json([
            'post' => new PostResource($post),
        ]);
    }

    /**
     * Обновить пост.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update-post', $post);

        $validated = $request->validated();
        if (isset($validated['content'])) {
            $validated['excerpt'] = \Illuminate\Support\Str::limit(strip_tags($validated['content']), 150);
        }

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => new PostResource($post->load('user')),
        ]);
    }

    /**
     * Удалить пост.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete-post', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }
}
