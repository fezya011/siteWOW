@extends('layout')

@section('title', 'Register - Laravel Posts')

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

            <!-- Заголовок -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">Create Account</h1>
                <p class="text-[#706f6c]">Join our community of Laravel developers</p>
            </div>

            <!-- Форма регистрации с поддержкой файлов -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="John Doe"
                        required
                        autofocus
                    >
                </div>

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
                    >
                </div>

                <!-- Profile Photo with Alpine.js -->
                <div x-data="{ photoName: null, photoPreview: null }">
                    <!-- Photo File Input -->
                    <input type="file"
                           class="hidden"
                           name="avatar"
                           accept="image/*"
                           x-ref="photo"
                           x-on:change="
                            if ($refs.photo.files[0]) {
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                            }"
                    >

                    <label class="block text-sm font-medium text-[#1b1b18] mb-2 text-center" for="photo">
                        Profile Photo <span class="text-[#706f6c]">(Optional)</span>
                    </label>

                    <div class="text-center">
                        <!-- Current Profile Photo / Default -->
                        <div class="mt-2" x-show="!photoPreview">
                            <div class="w-32 h-32 m-auto rounded-full bg-[#dbdbd7] flex items-center justify-center">
                                <svg class="w-16 h-16 text-[#706f6c]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-32 h-32 rounded-full m-auto shadow-lg"
                                  x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <button type="button"
                                class="mt-3 px-4 py-2 bg-white border border-[#e3e3e0] text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg font-medium transition-colors inline-flex items-center"
                                x-on:click.prevent="$refs.photo.click()">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Select New Photo
                        </button>

                        <p x-show="photoName" class="mt-2 text-xs text-[#706f6c]" x-text="photoName"></p>
                    </div>
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
                    <p class="mt-1 text-xs text-[#706f6c]">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#1b1b18] mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg text-[#1b1b18] placeholder-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#F53003] transition-all"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        class="mt-1 h-4 w-4 text-[#F53003] border-[#e3e3e0] rounded focus:ring-[#F53003]"
                        required
                    >
                    <label for="terms" class="ml-2 block text-sm text-[#706f6c]">
                        I agree to the
                        <a href="#" class="text-[#F53003] hover:underline">Terms of Service</a>
                        and
                        <a href="#" class="text-[#F53003] hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Create Account
                </button>

                <!-- Login Link -->
                <div class="text-center pt-4 border-t border-[#e3e3e0]">
                    <p class="text-[#706f6c]">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-[#F53003] hover:underline font-medium">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js for photo preview -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection
