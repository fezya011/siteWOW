<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use App\Service\PostsServices\CreatePostService;
use App\Service\PostsServices\FilterPostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request, FilterPostsService $filter)
    {
        $posts = $filter->execute($request);

        return view('front/home', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create-post');

        return view('front/createPost');
    }

    public function store(StorePostRequest $request, CreatePostService $action)
    {
        $this->authorize('create-post');

        $action->execute(auth()->user(), $request->validated());

        return redirect()->route('home')->with('success', 'Пост успешно создан!');
    }

    public function show(Post $post)
    {
        return view('front/show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update-post', $post);

        return view('front.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update-post', $post);

        $validated = $request->validated();
        $validated['excerpt'] ??= Str::limit(strip_tags($validated['content']), 150);

        $post->update($validated);

        return redirect()->route('show', $post)->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete-post', $post);
        $post->delete();

        return redirect()->route('home')->with('success', 'Пост успешно удалён!');
    }
}
