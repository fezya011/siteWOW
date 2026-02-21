@extends('layout')

@section('title', $post->title . ' - Laravel Posts')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Сообщения об успехе/ошибках -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-4xl mx-auto">
            <!-- Навигация назад -->
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center text-[#706f6c] hover:text-[#1b1b18] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to all posts
                </a>
            </div>

            <!-- Категория и дата -->
            <div class="flex items-center justify-between mb-4">
                <span class="px-3 py-1
                    @if($post->category == 'Technology') bg-[#fff2f2] text-[#F53003]
                    @elseif($post->category == 'Design') bg-[#f5f5f4] text-[#1b1b18]
                    @elseif($post->category == 'Development') bg-[#f0f9ff] text-[#0369a1]
                    @elseif($post->category == 'Tutorial') bg-[#fef7cd] text-[#92400e]
                    @elseif($post->category == 'Vue.js') bg-[#f3e8ff] text-[#7c3aed]
                    @elseif($post->category == 'Testing') bg-[#dcfce7] text-[#166534]
                    @else bg-[#f5f5f4] text-[#1b1b18]
                    @endif
                    text-sm font-medium rounded-full">
                    {{ $post->category ?? 'Uncategorized' }}
                </span>
                <span class="text-sm text-[#706f6c]">
                    {{ $post->created_at->format('F j, Y') }} · {{ $post->created_at->diffForHumans() }}
                </span>
            </div>

            <!-- Заголовок -->
            <h1 class="text-4xl lg:text-5xl font-bold text-[#1b1b18] mb-6">
                {{ $post->title }}
            </h1>

            <!-- Информация об авторе -->
            <div class="flex items-center justify-between mb-8 pb-8 border-b border-[#e3e3e0]">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-[#dbdbd7] flex items-center justify-center">
                        <span class="text-lg font-medium text-[#1b1b18]">
                            {{ $post->author_initials }}
                        </span>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-[#1b1b18]">{{ $post->author }}</p>
                        <p class="text-sm text-[#706f6c]">Author</p>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <span class="flex items-center text-[#706f6c]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        {{ $post->likes }} likes
                    </span>
                    <span class="flex items-center text-[#706f6c]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ $post->comments }} comments
                    </span>
                </div>
            </div>

            <!-- Контент поста -->
            <div class="prose prose-lg max-w-none mb-8">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Админские действия -->
            @auth
                @if(auth()->user()->role === 'admin' || auth()->id() === $post->user_id)
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-[#e3e3e0]">
                        <a href="{{ route('posts.edit', $post) }}"
                           class="px-4 py-2 bg-[#f5f5f4] text-[#1b1b18] hover:bg-[#e3e3e0] rounded-lg font-medium transition-colors inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this post?')"
                                    class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-medium transition-colors inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <!-- Секция комментариев -->
            <div class="mt-8 pt-8 border-t border-[#e3e3e0]">
                <h2 class="text-2xl font-bold text-[#1b1b18] mb-6">Comments ({{ $post->comments }})</h2>

                @auth
                    <form class="mb-8">
                        <textarea
                            rows="3"
                            class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                            placeholder="Write a comment..."
                        ></textarea>
                        <div class="flex justify-end mt-2">
                            <button class="px-4 py-2 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors">
                                Post Comment
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-center text-[#706f6c] py-8">
                        <a href="{{ route('login') }}" class="text-[#F53003] hover:underline">Sign in</a> to leave a comment
                    </p>
                @endauth
            </div>
        </div>
    </div>
@endsection
