<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel Posts')</title>

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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
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

    @stack('styles')
</head>
<body class="bg-[#FDFDFC] dark:bg-custom-dark transition-colors duration-300">
<!-- Хедер -->
<header class="sticky top-0 z-50 bg-white/80 dark:bg-custom-dark/80 backdrop-blur-sm border-b border-[#e3e3e0] dark:border-custom-dark">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Логотип -->
            <div class="flex items-center">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2">
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
<main>
    @yield('content')
</main>

<!-- Футер -->
<footer class="border-t border-[#e3e3e0] dark:border-custom-dark bg-white dark:bg-card-dark">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-[#F53003] dark:text-[#F61500]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-lg font-semibold text-[#1b1b18] dark:text-light">Laravel Posts</span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c] dark:text-muted">A community for Laravel developers</p>
            </div>

            <div class="flex space-x-6">
                <a href="{{ url('/about') }}" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">About</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Contact</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Privacy</a>
                <a href="#" class="text-sm text-[#706f6c] dark:text-muted hover:text-[#1b1b18] dark:hover:text-light transition-colors">Terms</a>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-[#e3e3e0] dark:border-custom-dark text-center">
            <p class="text-sm text-[#706f6c] dark:text-muted">© 2026 Laravel Posts. All rights reserved.</p>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
