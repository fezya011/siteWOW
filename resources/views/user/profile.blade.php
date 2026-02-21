{{-- resources/views/profile.blade.php --}}
@extends('layout')

@section('title', 'Profile - ' . $user->name)

@section('content')
    <main class="profile-page">
        <!-- Верхний баннер -->
        <section class="relative block h-96">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                 style="background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2710&q=80');">
                <span class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>

            <!-- Нижний изгиб -->
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-16" style="transform: translateZ(0)">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-[#FDFDFC] dark:text-custom-dark fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>

        <!-- Профиль -->
        <section class="relative py-16 bg-[#FDFDFC] dark:bg-custom-dark">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-card-dark w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <!-- Аватар и статистика -->
                        <div class="flex flex-wrap justify-center">
                            <!-- Левая колонка (статистика) -->
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block uppercase tracking-wide text-[#1b1b18] dark:text-light">{{ $postsCount ?? 0 }}</span>
                                        <span class="text-sm text-[#706f6c] dark:text-muted">Posts</span>
                                    </div>
                                    <div class="mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block uppercase tracking-wide text-[#1b1b18] dark:text-light">{{ $photosCount ?? 0 }}</span>
                                        <span class="text-sm text-[#706f6c] dark:text-muted">Photos</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block uppercase tracking-wide text-[#1b1b18] dark:text-light">{{ $commentsCount ?? 0 }}</span>
                                        <span class="text-sm text-[#706f6c] dark:text-muted">Comments</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Центр (аватар) -->
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative -mt-24">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                             alt="{{ $user->name }}"
                                             class="shadow-xl rounded-full h-32 w-32 object-cover border-4 border-white dark:border-card-dark"
                                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF';">
                                    @else
                                        <div class="shadow-xl rounded-full h-32 w-32 bg-gradient-to-br from-[#F53003] to-[#FF4433] flex items-center justify-center text-white text-4xl font-bold border-4 border-white dark:border-card-dark">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Правая колонка (кнопка) -->
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    @auth
                                        @if(auth()->id() === $user->id)
                                            <a href="{{ route('profile.edit') }}"
                                               class="bg-[#F53003] hover:bg-[#FF4433] text-white font-bold text-sm px-4 py-2 rounded-lg shadow hover:shadow-md transition-all duration-300 inline-flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                                Edit Profile
                                            </a>
                                        @else
                                            <button class="bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white font-bold text-sm px-4 py-2 rounded-lg shadow hover:shadow-md transition-all duration-300 inline-flex items-center"
                                                    onclick="window.location.href='{{ route('chat.with', $user) }}'">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                Message
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>

                        <!-- Информация о пользователе -->
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-[#1b1b18] dark:text-light">
                                {{ $user->name }}
                                @if($user->role === 'admin')
                                    <span class="ml-2 px-3 py-1 text-sm bg-[#F53003] text-white rounded-full">Admin</span>
                                @endif
                            </h3>

                            @if($user->location)
                                <div class="text-sm leading-normal mt-0 mb-2 text-[#706f6c] dark:text-muted font-bold uppercase">
                                    <i class="fas fa-map-marker-alt mr-2 text-lg"></i>
                                    {{ $user->location }}
                                </div>
                            @endif

                            @if($user->occupation)
                                <div class="mb-2 text-[#706f6c] dark:text-muted mt-6">
                                    <i class="fas fa-briefcase mr-2 text-lg"></i>
                                    {{ $user->occupation }}
                                </div>
                            @endif

                            @if($user->education)
                                <div class="mb-2 text-[#706f6c] dark:text-muted">
                                    <i class="fas fa-university mr-2 text-lg"></i>
                                    {{ $user->education }}
                                </div>
                            @endif

                            @if($user->website)
                                <div class="mb-2 text-[#706f6c] dark:text-muted">
                                    <i class="fas fa-link mr-2 text-lg"></i>
                                    <a href="{{ $user->website }}" target="_blank" class="text-[#F53003] hover:underline">
                                        {{ str_replace(['https://', 'http://'], '', $user->website) }}
                                    </a>
                                </div>
                            @endif

                            @if($user->email)
                                <div class="mb-2 text-[#706f6c] dark:text-muted">
                                    <i class="fas fa-envelope mr-2 text-lg"></i>
                                    <a href="mailto:{{ $user->email }}" class="hover:text-[#F53003]">
                                        {{ $user->email }}
                                    </a>
                                </div>
                            @endif

                            @if($user->phone)
                                <div class="mb-2 text-[#706f6c] dark:text-muted">
                                    <i class="fas fa-phone mr-2 text-lg"></i>
                                    <a href="tel:{{ $user->phone }}" class="hover:text-[#F53003]">
                                        {{ $user->phone }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Биография -->
                        @if($user->bio)
                            <div class="mt-10 py-10 border-t border-[#e3e3e0] dark:border-custom-dark text-center">
                                <div class="flex flex-wrap justify-center">
                                    <div class="w-full lg:w-9/12 px-4">
                                        <p class="mb-4 text-lg leading-relaxed text-[#706f6c] dark:text-muted">
                                            {{ $user->bio }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Социальные ссылки -->
                        <div class="flex justify-center space-x-4 pb-8">
                            @if($user->facebook)
                                <a href="{{ $user->facebook }}" target="_blank" class="text-[#706f6c] hover:text-[#F53003] transition-colors">
                                    <i class="fab fa-facebook-f text-xl"></i>
                                </a>
                            @endif

                            @if($user->twitter)
                                <a href="{{ $user->twitter }}" target="_blank" class="text-[#706f6c] hover:text-[#F53003] transition-colors">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            @endif

                            @if($user->instagram)
                                <a href="{{ $user->instagram }}" target="_blank" class="text-[#706f6c] hover:text-[#F53003] transition-colors">
                                    <i class="fab fa-instagram text-xl"></i>
                                </a>
                            @endif

                            @if($user->github)
                                <a href="{{ $user->github }}" target="_blank" class="text-[#706f6c] hover:text-[#F53003] transition-colors">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                            @endif

                            @if($user->linkedin)
                                <a href="{{ $user->linkedin }}" target="_blank" class="text-[#706f6c] hover:text-[#F53003] transition-colors">
                                    <i class="fab fa-linkedin-in text-xl"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Посты пользователя -->
                @if(isset($userPosts) && $userPosts->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-light mb-6">Posts by {{ $user->name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userPosts as $post)
                                <article class="bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 bg-[#f5f5f4] dark:bg-[#1a1a1a] text-xs font-medium rounded-full">
                                        {{ $post->category ?? 'Uncategorized' }}
                                    </span>
                                            <span class="text-xs text-[#706f6c] dark:text-muted">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                        </div>
                                        <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-light mb-3">
                                            <a href="{{ route('show', $post) }}" class="hover:text-[#F53003] transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-[#706f6c] dark:text-muted mb-4 line-clamp-2">
                                            {{ $post->excerpt ?? substr(strip_tags($post->content), 0, 100) . '...' }}
                                        </p>
                                        <div class="flex items-center justify-between pt-4 border-t border-[#e3e3e0] dark:border-custom-dark">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm text-[#1b1b18] dark:text-light">{{ $post->likes }} likes</span>
                                                <span class="text-sm text-[#706f6c] dark:text-muted">•</span>
                                                <span class="text-sm text-[#1b1b18] dark:text-light">{{ $post->comments }} comments</span>
                                            </div>
                                            <a href="{{ route('show', $post) }}" class="text-[#F53003] hover:text-[#FF4433] text-sm font-medium">
                                                Read more →
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
