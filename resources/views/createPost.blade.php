@extends('layout')

@section('title', 'Create Post - Laravel Posts')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Сообщения об успехе/ошибках -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Заголовок -->
            <div class="mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Create New Post</h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A]">Share your knowledge with the community</p>
            </div>

            <!-- Форма -->
            <form method="POST" action="{{ url('/posts') }}" class="space-y-6">
                @csrf

                <!-- Заголовок -->
                <div>
                    <label for="title" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Post Title *
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        placeholder="Enter post title"
                        required
                    >
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Make it clear and descriptive</p>
                </div>

                <!-- Категория и автор -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Категория -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Category *
                        </label>
                        <select
                            id="category"
                            name="category"
                            class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                            required
                        >
                            <option value="">Select a category</option>
                            <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Development" {{ old('category') == 'Development' ? 'selected' : '' }}>Development</option>
                            <option value="Tutorial" {{ old('category') == 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
                            <option value="Vue.js" {{ old('category') == 'Vue.js' ? 'selected' : '' }}>Vue.js</option>
                            <option value="Testing" {{ old('category') == 'Testing' ? 'selected' : '' }}>Testing</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Автор -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Author Name *
                        </label>
                        <input
                            type="text"
                            id="author"
                            name="author"
                            value="{{ old('author') }}"
                            class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                            placeholder="Your name"
                            required
                        >
                    </div>
                </div>

                <!-- Инициалы автора -->
                <div>
                    <label for="author_initials" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Author Initials (2 letters) *
                    </label>
                    <input
                        type="text"
                        id="author_initials"
                        name="author_initials"
                        value="{{ old('author_initials') }}"
                        class="w-20 px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all uppercase"
                        placeholder="JD"
                        maxlength="2"
                        required
                        oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')"
                    >
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Used for author avatar</p>
                </div>

                <!-- Контент -->
                <div>
                    <label for="content" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Content *
                    </label>

                    <div class="mb-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        Просто напишите текст. Поддерживается HTML и Markdown.
                    </div>

                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        placeholder="Write your post content here..."
                        required
                    >{{ old('content') }}</textarea>

                    <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full mr-2"></span>
                            <span>Supports HTML</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full mr-2"></span>
                            <span>Markdown ready</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full mr-2"></span>
                            <span>Code blocks</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full mr-2"></span>
                            <span>No JavaScript needed</span>
                        </div>
                    </div>
                </div>

                <!-- Краткое описание (опционально) -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Excerpt (Optional)
                    </label>
                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="3"
                        class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        placeholder="Brief summary of your post (will be auto-generated from content if empty)"
                    >{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Leave empty for auto-generation</p>
                </div>

                <!-- Статистика (начальные значения) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="likes" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Initial Likes
                        </label>
                        <input
                            type="number"
                            id="likes"
                            name="likes"
                            value="{{ old('likes', 0) }}"
                            min="0"
                            class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        >
                    </div>

                    <div>
                        <label for="comments" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Initial Comments
                        </label>
                        <input
                            type="number"
                            id="comments"
                            name="comments"
                            value="{{ old('comments', 0) }}"
                            min="0"
                            class="w-full px-4 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                        >
                    </div>
                </div>

                <!-- Кнопки действий -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#e3e3e0] dark:border-custom-dark">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Publish Post
                    </button>

                    <a href="{{ url('/posts') }}"
                       class="px-6 py-3 bg-white dark:bg-card-dark border border-[#e3e3e0] dark:border-custom-dark text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f4] dark:hover:bg-[#1a1a1a] rounded-lg font-medium transition-colors flex items-center justify-center text-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
