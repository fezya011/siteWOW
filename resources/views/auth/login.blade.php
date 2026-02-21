@extends('layout')

@section('title', 'Login - Laravel Posts')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="max-w-md mx-auto">
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

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Заголовок -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">Welcome Back</h1>
                <p class="text-[#706f6c]">Sign in to your account</p>
            </div>

            <!-- Форма логина -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="your@email.com"
                        required
                        autofocus
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="h-4 w-4 text-[#F53003] border-[#e3e3e0] rounded focus:ring-[#F53003]"
                        >
                        <label for="remember" class="ml-2 block text-sm text-[#706f6c]">
                            Remember me
                        </label>
                    </div>

                    <a href="#" class="text-sm text-[#F53003] hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>

                <!-- Register Link -->
                <div class="text-center pt-4 border-t border-[#e3e3e0]">
                    <p class="text-[#706f6c]">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-[#F53003] hover:underline font-medium">
                            Create one now
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
