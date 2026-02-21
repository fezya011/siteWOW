@extends('layout')

@section('title', 'Edit Post - Laravel Posts')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Сообщения об ошибках -->
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
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">Edit Post</h1>
                        <p class="text-[#706f6c]">Make changes to your post</p>
                    </div>
                    <a href="{{ route('show', $post) }}" class="text-[#706f6c] hover:text-[#1b1b18]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Форма редактирования -->
            <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Заголовок -->
                <div>
                    <label for="title" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Post Title *
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $post->title) }}"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        required
                    >
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
                        <option value="Technology" {{ old('category', $post->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Design" {{ old('category', $post->category) == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Development" {{ old('category', $post->category) == 'Development' ? 'selected' : '' }}>Development</option>
                        <option value="Tutorial" {{ old('category', $post->category) == 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
                        <option value="Vue.js" {{ old('category', $post->category) == 'Vue.js' ? 'selected' : '' }}>Vue.js</option>
                        <option value="Testing" {{ old('category', $post->category) == 'Testing' ? 'selected' : '' }}>Testing</option>
                        <option value="Other" {{ old('category', $post->category) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Контент -->
                <div>
                    <label for="content" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Content *
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        required
                    >{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Краткое описание -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Excerpt (Optional)
                    </label>
                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="3"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                    >{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <!-- Кнопки действий -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#e3e3e0]">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Post
                    </button>

                    <a href="{{ route('show', $post) }}"
                       class="px-6 py-3 bg-white border border-[#e3e3e0] text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg font-medium transition-colors flex items-center justify-center text-center"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
