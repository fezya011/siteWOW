{{-- resources/views/errors/404.blade.php --}}
@extends('layout')

@section('title', '404 - Page Not Found')

@section('content')
    <main class="h-screen w-full flex flex-col justify-center items-center bg-white">
        <!-- 404 номер -->
        <h1 class="text-9xl font-extrabold text-black tracking-widest mt-20 mb-0 drop-shadow-lg relative">
            404
        </h1>

        <!-- Повернутый бейдж -->
        <div class="bg-gray-200 px-4 py-2 text-sm font-medium text-black rounded-lg rotate-12 mb-10 shadow-md absolute">
            Page Not Found
        </div>

        <!-- Кнопка с эффектом -->
        <div class="mt-16 relative">
            <a href="{{ route('home') }}"
               class="relative inline-block text-sm font-medium text-gray-700 group focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
            >
                <!-- Анимированная подложка -->
                <span class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-gray-300 group-hover:translate-y-0 group-hover:translate-x-0 rounded-lg"></span>

                <!-- Основной блок кнопки -->
                <span class="relative block px-8 py-3 bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                <span class="relative z-10 flex items-center justify-center font-semibold">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Go to Homepage
                </span>
            </span>
            </a>
        </div>

        <!-- Дополнительный текст -->
        <p class="text-gray-500 mt-8 text-base relative">
            The page you're looking for doesn't exist or has been moved.
        </p>

        <!-- Кнопка "Назад" -->
        <button onclick="history.back()"
                class="mt-6 text-gray-500 hover:text-black transition-colors duration-300 text-sm flex items-center group relative">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Go back to previous page
        </button>

        <!-- Опционально: простая линия для красоты -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center">
            <div class="w-24 h-1 bg-gray-200 rounded-full"></div>
        </div>
    </main>
@endsection
