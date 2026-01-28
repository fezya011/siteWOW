@extends('layout')

@section('title', 'Laravel Posts - Latest Posts')

@section('content')
    <!-- Основной контент -->
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Сообщение об успехе -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Заголовок и кнопка создания -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] dark:text-light mb-2">
                    @if(request()->has('category') && request('category') != 'all')
                        {{ ucfirst(request('category')) }} Posts
                    @else
                        Latest Posts
                    @endif
                </h1>
                <p class="text-[#706f6c] dark:text-muted">Discover articles from our community</p>
            </div>

            <a href="{{ url('/posts/create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Post
            </a>
        </div>

        <!-- Поиск и фильтры (форма) -->
        <form method="GET" action="{{ url('/posts') }}" class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search posts..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 pl-12 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-light placeholder-[#706f6c] dark:placeholder-muted focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        >
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#706f6c] dark:text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select name="sort" class="px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-light focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433]">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    </select>
                    <select name="category" class="px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-light focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433]">
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
                    <button type="submit" class="px-4 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors">
                        Apply Filters
                    </button>
                    @if(request()->has('search') || request()->has('sort') || request()->has('category'))
                        <a href="{{ url('/posts') }}" class="px-4 py-3 bg-[#f5f5f4] dark:bg-[#1a1a1a] text-[#1b1b18] dark:text-light hover:bg-[#e3e3e0] dark:hover:bg-[#3E3E3A] rounded-lg font-medium transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Сетка постов -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="group bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1
                            @if($post->category == 'Technology') bg-[#fff2f2] dark:bg-[#1D0002] text-[#F53003] dark:text-[#FF4433]
                            @elseif($post->category == 'Design') bg-[#f5f5f4] dark:bg-[#1a1a1a] text-[#1b1b18] dark:text-light
                            @elseif($post->category == 'Development') bg-[#f0f9ff] dark:bg-[#0c1a2d] text-[#0369a1] dark:text-[#38bdf8]
                            @elseif($post->category == 'Tutorial') bg-[#fef7cd] dark:bg-[#2d2a00] text-[#92400e] dark:text-[#fbbf24]
                            @elseif($post->category == 'Vue.js') bg-[#f3e8ff] dark:bg-[#2e1065] text-[#7c3aed] dark:text-[#a78bfa]
                            @elseif($post->category == 'Testing') bg-[#dcfce7] dark:bg-[#052e16] text-[#166534] dark:text-[#4ade80]
                            @else bg-[#f5f5f4] dark:bg-[#1a1a1a] text-[#1b1b18] dark:text-light
                            @endif
                            text-xs font-medium rounded-full">
                            {{ $post->category ?? 'Uncategorized' }}
                        </span>
                            <span class="text-xs text-[#706f6c] dark:text-muted">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                        </div>

                        <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-light mb-3 group-hover:text-[#F53003] dark:group-hover:text-[#FF4433] transition-colors">
                            {{ $post->title }}
                        </h3>

                        <p class="text-[#706f6c] dark:text-muted mb-4 line-clamp-3">
                            {{ $post->excerpt ?? substr(strip_tags($post->content), 0, 100) . '...' }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-[#e3e3e0] dark:border-custom-dark">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] flex items-center justify-center">
                                <span class="text-sm font-medium text-[#1b1b18] dark:text-light">
                                    {{ $post->author_initials ?? substr($post->author, 0, 2) }}
                                </span>
                                </div>
                                <span class="text-sm text-[#1b1b18] dark:text-light">{{ $post->author }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                            <span class="flex items-center text-sm text-[#706f6c] dark:text-muted">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ $post->likes }}
                            </span>
                                <span class="flex items-center text-sm text-[#706f6c] dark:text-muted">
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
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-light mb-2">No posts found</h3>
                    <p class="text-[#706f6c] dark:text-muted mb-6">
                        @if(request()->has('search') || request()->has('category'))
                            Try different search terms or clear filters
                        @else
                            Be the first to create a post!
                        @endif
                    </p>
                    @if(request()->has('search') || request()->has('category'))
                        <a href="{{ url('/posts') }}" class="inline-flex items-center px-5 py-2.5 bg-[#f5f5f4] dark:bg-[#1a1a1a] text-[#1b1b18] dark:text-light hover:bg-[#e3e3e0] dark:hover:bg-[#3E3E3A] rounded-lg font-medium transition-colors mr-4">
                            Clear Filters
                        </a>
                    @endif
                    <a href="{{ url('/posts/create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors">
                        Create Post
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
