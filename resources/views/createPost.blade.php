<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Post - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .editor-toolbar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }

        .editor-button {
            padding: 0.375rem 0.75rem;
            background: #f5f5f4;
            border: 1px solid #e3e3e0;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .editor-button:hover {
            background: #e3e3e0;
        }

        .dark .editor-button {
            background: #3E3E3A;
            border-color: #3E3E3A;
            color: #EDEDEC;
        }

        .dark .editor-button:hover {
            background: #4a4a46;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen transition-colors duration-300">
<!-- Навигация -->
<header class="sticky top-0 z-50 bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur-sm border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Логотип -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-[#F53003] dark:text-[#F61500]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Create Post</span>
                </a>
            </div>

            <!-- Навигационные ссылки -->
            <nav class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f4] dark:hover:bg-[#1a1a1a] rounded-lg transition-colors">
                    Home
                </a>
                <a href="{{ route('posts.index') }}" class="px-4 py-2 text-sm bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg transition-colors">
                    All Posts
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Основной контент -->
<main class="container mx-auto px-4 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок -->
        <div class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Create New Post</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A]">Share your knowledge with the community</p>
        </div>

        <!-- Форма -->
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Оповещения об ошибках -->
            @if ($errors->any())
                <div class="bg-[#fff2f2] dark:bg-[#1D0002] border border-[#f53003] dark:border-[#FF4433] rounded-lg p-4">
                    <p class="text-[#f53003] dark:text-[#FF4433] font-medium mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-sm text-[#f53003] dark:text-[#FF4433]">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                    class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
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
                        class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
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
                        class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
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
                    class="w-20 px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all uppercase"
                    placeholder="JD"
                    maxlength="2"
                    required
                >
                <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Used for author avatar</p>
            </div>

            <!-- Контент -->
            <div>
                <label for="content" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Content *
                </label>

                <!-- Простой WYSIWYG тулбар -->
                <div class="editor-toolbar mb-2">
                    <button type="button" class="editor-button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" class="editor-button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" class="editor-button" onclick="formatText('underline')"><u>U</u></button>
                    <button type="button" class="editor-button" onclick="insertList()">• List</button>
                    <button type="button" class="editor-button" onclick="insertCode()">{ }</button>
                    <button type="button" class="editor-button" onclick="insertLink()">🔗 Link</button>
                </div>

                <textarea
                    id="content"
                    name="content"
                    rows="12"
                    class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all font-mono text-sm"
                    placeholder="Write your post content here... Use markdown or HTML if needed."
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
                        <span>Auto-save draft</span>
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
                    class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#706f6c] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
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
                        class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
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
                        class="w-full px-4 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] dark:focus:ring-[#FF4433] transition-all"
                    >
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <button
                    type="submit"
                    class="px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white rounded-lg font-medium transition-colors flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Publish Post
                </button>

                <button
                    type="button"
                    onclick="window.location.href='{{ route('posts.index') }}'"
                    class="px-6 py-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f4] dark:hover:bg-[#1a1a1a] rounded-lg font-medium transition-colors flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </button>

                <button
                    type="button"
                    onclick="saveDraft()"
                    class="px-6 py-3 bg-[#fff2f2] dark:bg-[#1D0002] border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#F53003] dark:text-[#FF4433] hover:bg-[#ffe6e6] dark:hover:bg-[#2a0000] rounded-lg font-medium transition-colors flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    Save as Draft
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Футер -->
<footer class="mt-16 border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615]">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-[#F53003] dark:text-[#F61500]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Laravel Posts</span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">Create and share your knowledge</p>
            </div>
        </div>
    </div>
</footer>

<!-- Скрипты -->
<script>
    // Проверяем сохраненную тему
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }

    // Функции для WYSIWYG редактора
    function formatText(command) {
        document.execCommand(command, false, null);
        document.getElementById('content').focus();
    }

    function insertList() {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const selectedText = text.substring(start, end);

        if (selectedText) {
            const lines = selectedText.split('\n');
            const listItems = lines.map(line => line.trim() ? `• ${line}` : '').join('\n');
            textarea.value = text.substring(0, start) + listItems + text.substring(end);
        } else {
            document.execCommand('insertText', false, '• ');
        }
        textarea.focus();
    }

    function insertCode() {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const selectedText = text.substring(start, end);

        if (selectedText) {
            textarea.value = text.substring(0, start) + '```\n' + selectedText + '\n```' + text.substring(end);
        } else {
            document.execCommand('insertText', false, '```\n\n```');
            textarea.selectionStart = textarea.selectionEnd - 4;
        }
        textarea.focus();
    }

    function insertLink() {
        const url = prompt('Enter URL:', 'https://');
        if (url) {
            const text = prompt('Enter link text:', 'Link');
            if (text !== null) {
                document.execCommand('insertHTML', false, `<a href="${url}" target="_blank">${text || url}</a>`);
            }
        }
    }

    // Автосохранение черновика
    let draftTimer;
    function autoSaveDraft() {
        clearTimeout(draftTimer);
        draftTimer = setTimeout(saveDraft, 2000);
    }

    function saveDraft() {
        const formData = {
            title: document.getElementById('title').value,
            content: document.getElementById('content').value,
            excerpt: document.getElementById('excerpt').value,
            category: document.getElementById('category').value,
            author: document.getElementById('author').value,
            author_initials: document.getElementById('author_initials').value,
            likes: document.getElementById('likes').value,
            comments: document.getElementById('comments').value
        };

        localStorage.setItem('postDraft', JSON.stringify(formData));

        // Показать уведомление
        showNotification('Draft saved locally', 'success');
    }

    function loadDraft() {
        const draft = localStorage.getItem('postDraft');
        if (draft) {
            const formData = JSON.parse(draft);

            document.getElementById('title').value = formData.title || '';
            document.getElementById('content').value = formData.content || '';
            document.getElementById('excerpt').value = formData.excerpt || '';
            document.getElementById('category').value = formData.category || '';
            document.getElementById('author').value = formData.author || '';
            document.getElementById('author_initials').value = formData.author_initials || '';
            document.getElementById('likes').value = formData.likes || 0;
            document.getElementById('comments').value = formData.comments || 0;

            if (formData.title || formData.content) {
                showNotification('Draft loaded from local storage', 'info');
            }
        }
    }

    function showNotification(message, type) {
        // Создаем элемент уведомления
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 px-4 py-3 rounded-lg shadow-lg ${
            type === 'success'
                ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300'
                : 'bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300'
        }`;
        notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    ${message}
                </div>
            `;

        document.body.appendChild(notification);

        // Удаляем через 3 секунды
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Загрузка черновика при загрузке страницы
    window.addEventListener('load', loadDraft);

    // Автосохранение при изменении полей
    document.getElementById('title').addEventListener('input', autoSaveDraft);
    document.getElementById('content').addEventListener('input', autoSaveDraft);
    document.getElementById('excerpt').addEventListener('input', autoSaveDraft);

    // Очистка черновика при успешной отправке
    document.querySelector('form').addEventListener('submit', function() {
        localStorage.removeItem('postDraft');
    });

    // Подсчет символов
    const contentTextarea = document.getElementById('content');
    const charCount = document.createElement('div');
    charCount.className = 'mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A] text-right';
    contentTextarea.parentNode.appendChild(charCount);

    function updateCharCount() {
        const length = contentTextarea.value.length;
        charCount.textContent = `${length} characters`;
    }

    contentTextarea.addEventListener('input', updateCharCount);
    updateCharCount();

    // Валидация инициалов
    const initialsInput = document.getElementById('author_initials');
    initialsInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '').substring(0, 2);
    });
</script>
</body>
</html>
