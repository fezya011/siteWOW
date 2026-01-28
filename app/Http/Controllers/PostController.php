<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('front/createPost');
    }

    public function about()
    {
        return view('front/about');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'author_initials' => 'required|string|size:2',
            'excerpt' => 'nullable|string|max:500',
            'likes' => 'nullable|integer|min:0',
            'comments' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = substr(strip_tags($validated['content']), 0, 150) . '...';
        }

        Post::create($validated);

        return redirect()->route('home')
            ->with('success', 'Пост успешно создан!');
    }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        switch ($request->get('sort', 'latest')) {
            case 'popular':
                $query->orderBy('likes', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $posts = $query->paginate(12);
        return view('front/home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('front/postsShow', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts')
            ->with('success', 'Пост успешно удален!');
    }
}
