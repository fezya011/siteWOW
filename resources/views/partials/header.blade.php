<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-sm border-b border-[#e3e3e0]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ url('/posts') }}" class="logo-wrap flex items-center space-x-2">
                    <svg class="w-8 h-8 text-[#F53003]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Тень -->
                        <circle cx="26" cy="26" r="18" fill="currentColor" fill-opacity="0.2"/>
                        <!-- Основной круг -->
                        <circle cx="22" cy="22" r="18" fill="currentColor"/>
                        <!-- Стрелка -->
                        <path d="M14 30L30 14M30 14H18M30 14V26" stroke="#FDFDFC" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xl font-mono font-semibold text-[#1b1b18]">
        <span class="text-[#1b1b18]">/</span>postly<span class="logo-cursor">_</span>
    </span>
                </a>
            </div>

            <nav class="flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-4">
                        @if(in_array(Auth::user()->role, ['user', 'admin']))
                            <a href="{{ route('createPost') }}" class="px-4 py-2 text-sm bg-[#1b1b18] text-white hover:bg-black rounded-lg transition-colors inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span class="hidden sm:inline">New Post</span>
                            </a>
                        @endif

                        <div class="relative" x-data="{ open: false }">
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

                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-[#e3e3e0] py-1 z-50">

                                <div class="px-4 py-3 border-b border-[#e3e3e0]">
                                    <p class="text-sm font-medium text-[#1b1b18]">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-[#706f6c]">{{ Auth::user()->email }}</p>
                                    @if(Auth::user()->role === 'admin')
                                        <span class="mt-1 inline-block px-2 py-0.5 text-xs bg-[#F53003] text-white rounded-full">Administrator</span>
                                    @endif
                                </div>

                                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>

                                @can('admin')
                                    <a href="#" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endcan

                                <a href="{{ route('profile.show', Auth::user()) }}" class="block px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
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
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-[#1b1b18] text-white hover:bg-black rounded-lg transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Register
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>
