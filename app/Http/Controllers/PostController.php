<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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

    public function store(Request $request)
    {
        // Проверяем авторизацию
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to create posts.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'likes' => 'nullable|integer|min:0',
            'comments' => 'nullable|integer|min:0',
        ]);

        // Автоматически подставляем данные пользователя
        $validated['author'] = Auth::user()->name;

        // Генерируем инициалы из имени пользователя
        $nameParts = explode(' ', Auth::user()->name);
        if (count($nameParts) >= 2) {
            // Если есть имя и фамилия
            $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        } else {
            // Если только одно слово
            $name = Auth::user()->name;
            $initials = strtoupper(substr($name, 0, min(2, strlen($name))));
        }
        $validated['author_initials'] = $initials;

        // Генерируем excerpt если не указан
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = substr(strip_tags($validated['content']), 0, 150) . '...';
        }

        // Добавляем ID пользователя
        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect()->route('home')
            ->with('success', 'Пост успешно создан!');
    }

    public function create()
    {
        // Проверяем авторизацию
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to create posts.');
        }

        return view('front/createPost');
    }

    public function edit(Post $post)
    {
        // Проверяем права (только автор или админ)
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('front.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Проверяем права (только автор или админ)
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'excerpt' => 'nullable',
        ]);

        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 150);
        }

        // Не обновляем автора и инициалы при редактировании
        $post->update($validated);

        return redirect()->route('show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function about()
    {
        return view('front/about');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('front/show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Проверяем права (только автор или админ)
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('home')
            ->with('success', 'Пост успешно удален!');
    }
}
