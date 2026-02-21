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
    </style>

    @stack('styles')
</head>
<body class="bg-[#FDFDFC]">
<!-- Хедер -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-sm border-b border-[#e3e3e0]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Логотип -->
            <div class="flex items-center">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-[#F53003]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-semibold text-[#1b1b18]">Laravel Posts</span>
                </a>
            </div>

            <!-- Навигационные ссылки -->
            <nav class="flex items-center space-x-4">
                @auth
                    <!-- Для авторизованных пользователей -->
                    <div class="flex items-center space-x-4">
                        @if(in_array(Auth::user()->role, ['user', 'admin']))
                            <a href="{{ route('createPost') }}" class="px-4 py-2 text-sm bg-[#1b1b18] text-white hover:bg-black rounded-lg transition-colors inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span class="hidden sm:inline">New Post</span>
                            </a>
                        @endif

                        <!-- Выпадающее меню пользователя -->
                        <div class="relative" x-data="{ open: false }">
                            <!-- Кнопка с аватаром -->
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none group">
                                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-transparent group-hover:border-[#F53003] transition-all duration-300">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF';">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-[#F53003] to-[#FF4433] flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr(Auth::user()->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <svg class="w-4 h-4 text-[#706f6c]" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Выпадающее меню -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-[#e3e3e0] py-1 z-50">

                                <!-- Информация о пользователе -->
                                <div class="px-4 py-3 border-b border-[#e3e3e0]">
                                    <p class="text-sm font-medium text-[#1b1b18]">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-[#706f6c]">{{ Auth::user()->email }}</p>
                                    @if(Auth::user()->role === 'admin')
                                        <span class="mt-1 inline-block px-2 py-0.5 text-xs bg-[#F53003] text-white rounded-full">Administrator</span>
                                    @endif
                                </div>

                                <!-- Ссылки меню -->
                                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>

                                @if(Auth::user()->role === 'admin')
                                    <a href="#" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif

                                <a href=" {{route('profile.show', Auth::user())}} " class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>

                                <a href="#" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Settings
                                </a>

                                <div class="border-t border-[#e3e3e0] my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-[#f5f5f4] transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Для гостей -->
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Login</span>
                    </a>

                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-[#1b1b18] text-white hover:bg-black rounded-lg transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Register</span>
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>

<!-- Основной контент -->
<main>
    @yield('content')
</main>

<!-- Футер -->
<footer class="border-t border-[#e3e3e0] bg-white">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-[#F53003]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-lg font-semibold text-[#1b1b18]">Laravel Posts</span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c]">A community for Laravel developers</p>
            </div>

            <div class="flex space-x-6">
                <a href="{{ url('/about') }}" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">About</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Contact</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Privacy</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Terms</a>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-[#e3e3e0] text-center">
            <p class="text-sm text-[#706f6c]">© 2026 Laravel Posts. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

@stack('scripts')
</body>
</html>
