<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('home', compact('posts'));
    }

    public function create()
    {
        return view('createPost');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'excerpt' => 'nullable|max:500',
            'category' => 'required|max:50',
            'author' => 'required|max:100',
            'author_initials' => 'required|max:2|min:2|alpha',
            'likes' => 'nullable|integer|min:0',
            'comments' => 'nullable|integer|min:0',
        ]);

        $validated = ['title'];
        $validated['slug'] = Str::slug($validated['title']);

        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 150);
        }

        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }




}
