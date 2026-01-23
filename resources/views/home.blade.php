<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Posts</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-custom-dark {
                background-color: #0a0a0a;
            }
            .dark\:bg-card-dark {
                background-color: #161615;
            }
            .dark\:border-custom-dark {
                border-color: #3E3E3A;
            }
            .dark\:text-light {
                color: #EDEDEC;
            }
            .dark\:text-muted {
                color: #A1A09A;
            }
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-custom-dark min-h-screen transition-colors duration-300">
<!-- Навигация -->
<header class="sticky top-0 z-50 bg-white/80 dark:bg-custom-dark/80 backdrop-blur-sm border-b border-[#e3e3e0] dark:border-custom-dark">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Логотип -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-[#F53003] dark:text-[#F61500]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-semibold text-[#1b1b18] dark:text-light">Laravel Posts</span>
                </a>
            </div>

            <!-- Навигационные ссылки -->
            <nav class="flex items-center space-x-4">
                <a href="#" class="px-4 py-2 text-sm text-[#1b1b18] dark:text-light hover:bg-[#f5f5f4] dark:hover:bg-[#1a1a1a] rounded-lg transition-colors">
                    Dashboard
                </a>
                <a href="{{ url('/posts/create') }}" class="px-4 py-2 text-sm bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg transition-colors">
                    New Post
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Основной контент -->
<main class="container mx-auto px-4 lg:px-8 py-8">
    <!-- Сообщение об успехе -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Заголовок и кнопка создания -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] dark:text-light mb-2">Latest Posts</h1>
            <p class="text-[#706f6c] dark:text-muted">Discover articles from our community</p>
        </div>

        <a href="{{ url('/posts/create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Post
        </a>
    </div>

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
                <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-light mb-2">No posts yet</h3>
                <p class="text-[#706f6c] dark:text-muted mb-6">Be the first to create a post!</p>
                <a href="{{ url('/posts/create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors">
                    Create First Post
                </a>
            </div>
        @endforelse
    </div>
</main>

<!-- Футер -->
<footer class="mt-16 border-t border-[#e3e3e0] dark:border-custom-dark bg-white dark:bg-card-dark">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="#" class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-[#F53003] dark:text-[#F61500]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-lg font-semibold text-[#1b1b18] dark:text-light">Laravel Posts</span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c] dark:text-muted">A community for Laravel developers</p>
            </div>

            <div class="flex space-x-6">
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">About</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Contact</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Privacy</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Terms</a>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-[#e3e3e0] dark:border-custom-dark text-center">
            <p class="text-sm text-[#706f6c] dark:text-muted">© 2024 Laravel Posts. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>
