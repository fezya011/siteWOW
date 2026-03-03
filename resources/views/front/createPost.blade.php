@extends('layout')

@section('title', 'Create Post - Postly')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Сообщения об успехе/ошибках -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Заголовок -->
            <div class="mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">Create New Post</h1>
                <p class="text-[#706f6c]">Share your knowledge with the community</p>
            </div>

            <!-- Форма -->
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
                @csrf

                <!-- Заголовок -->
                <div>
                    <label for="title" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Post Title *
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="Enter post title"
                        required
                    >
                    <p class="mt-1 text-sm text-[#706f6c]">Make it clear and descriptive</p>
                </div>

                <!-- Категория -->
                <div>
                    <label for="category" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Category *
                    </label>
                    <select
                        id="category"
                        name="category"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
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

                <!-- Контент -->
                <div>
                    <label for="content" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Content *
                    </label>

                    <div class="mb-2 text-sm text-[#706f6c]">
                        Просто напишите текст. Поддерживается HTML и Markdown.
                    </div>

                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="Write your post content here..."
                        required
                    >{{ old('content') }}</textarea>
                </div>

                <!-- Краткое описание (опционально) -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Excerpt (Optional)
                    </label>
                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="3"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="Brief summary of your post (will be auto-generated from content if empty)"
                    >{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-sm text-[#706f6c]">Leave empty for auto-generation</p>
                </div>

                <!-- Скрытые поля -->
                <input type="hidden" name="likes" value="0">
                <input type="hidden" name="comments" value="0">

                <!-- Кнопки действий -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#e3e3e0]">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Publish Post
                    </button>

                    <a href="{{ route('home') }}"
                       class="px-6 py-3 bg-white border border-[#e3e3e0] text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg font-medium transition-colors flex items-center justify-center text-center"
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
