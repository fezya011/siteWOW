@extends('layout')

@section('title', 'Laravel Posts - Latest Posts')

@section('content')
    <!-- Основной контент -->
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Сообщение об успехе -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Заголовок и кнопка создания -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">
                    @if(request()->has('category') && request('category') != 'all')
                        {{ ucfirst(request('category')) }} Posts
                    @else
                        Latest Posts
                    @endif
                </h1>
                <p class="text-[#706f6c]">Discover articles from our community</p>
            </div>

            @auth
                @if(in_array(Auth::user()->role, ['user', 'admin']))
                    <a href="{{ route('createPost') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Post
                    </a>
                @endif
            @endauth
        </div>

        <!-- Поиск и фильтры (форма) -->
        <form method="GET" action="{{ route('home') }}" class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search posts..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 pl-12 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        >
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#706f6c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select name="sort" class="px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    </select>
                    <select name="category" class="px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        <option value="all" {{ request('category') == 'all' || !request()->has('category') ? 'selected' : '' }}>All Categories</option>
                        <option value="Technology" {{ request('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Design" {{ request('category') == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Development" {{ request('category') == 'Development' ? 'selected' : '' }}>Development</option>
                        <option value="Tutorial" {{ request('category') == 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
                        <option value="Vue.js" {{ request('category') == 'Vue.js' ? 'selected' : '' }}>Vue.js</option>
                        <option value="Testing" {{ request('category') == 'Testing' ? 'selected' : '' }}>Testing</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors">
                        Apply Filters
                    </button>
                    @if(request()->has('search') || request()->has('sort') || request()->has('category'))
                        <a href="{{ route('home') }}" class="px-4 py-3 bg-[#f5f5f4] text-[#1b1b18] hover:bg-[#e3e3e0] rounded-lg font-medium transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Сетка постов -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="group bg-white border border-[#e3e3e0] rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="p-6">
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
                                text-xs font-medium rounded-full">
                                {{ $post->category ?? 'Uncategorized' }}
                            </span>
                            <span class="text-xs text-[#706f6c]">
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-[#1b1b18] mb-3 group-hover:text-[#F53003] transition-colors">
                            <a href="{{ route('show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-[#706f6c] mb-4 line-clamp-3">
                            {{ $post->excerpt ?? substr(strip_tags($post->content), 0, 100) . '...' }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-[#e3e3e0]">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-[#dbdbd7] flex items-center justify-center">
                                    <span class="text-sm font-medium text-[#1b1b18]">
                                        {{ $post->author_initials ?? substr($post->author, 0, 2) }}
                                    </span>
                                </div>
                                <span class="text-sm text-[#1b1b18]">{{ $post->author }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center text-sm text-[#706f6c]">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    {{ $post->likes }}
                                </span>
                                <span class="flex items-center text-sm text-[#706f6c]">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    {{ $post->comments }}
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-4xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] mb-2">No posts found</h3>
                    <p class="text-[#706f6c] mb-6">
                        @if(request()->has('search') || request()->has('category'))
                            Try different search terms or clear filters
                        @else
                            Be the first to create a post!
                        @endif
                    </p>
                    @if(request()->has('search') || request()->has('category'))
                        <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 bg-[#f5f5f4] text-[#1b1b18] hover:bg-[#e3e3e0] rounded-lg font-medium transition-colors mr-4">
                            Clear Filters
                        </a>
                    @endif
                    @auth
                        @if(in_array(Auth::user()->role, ['user', 'admin']))
                            <a href="{{ route('createPost') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors">
                                Create Post
                            </a>
                        @endif
                    @endauth
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
