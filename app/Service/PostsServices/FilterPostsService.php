<?php

namespace App\Service\PostsServices;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class FilterPostsService
{
    public function execute(Request $request): LengthAwarePaginator
    {
        return Post::query()
            ->when($request->filled('search'), fn($q) =>
            $q->where(fn($q) => $q
                ->whereLike('title', "%{$request->search}%")
                ->orWhereLike('content', "%{$request->search}%")
                ->orWhereLike('author', "%{$request->search}%")
            )
            )
            ->when($request->filled('category') && $request->category !== 'all', fn($q) =>
            $q->where('category', $request->category)
            )
            ->when($request->get('sort', 'latest'), function ($q, $sort) {
                match ($sort) {
                    'popular' => $q->orderByDesc('likes'),
                    'oldest'  => $q->orderBy('created_at'),
                    default   => $q->orderByDesc('created_at'),
                };
            })
            ->paginate(12);
    }
}
