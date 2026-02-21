
@extends('layout')

@section('title', 'Edit Profile - ' . $user->name)

@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
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
            <div class="mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-[#1b1b18] mb-2">Edit Profile</h1>
                <p class="text-[#706f6c]">Update your personal information</p>
            </div>

            <!-- Форма редактирования -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 bg-white p-8 rounded-xl shadow-sm border border-[#e3e3e0]">
                @csrf
                @method('PUT')

                <!-- Основная информация -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-[#1b1b18] pb-2 border-b border-[#e3e3e0]">Basic Information</h2>

                    <div>
                        <label for="name" class="block text-sm font-medium text-[#1b1b18] mb-2">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-[#1b1b18] mb-2">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-[#1b1b18] mb-2">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]"
                               placeholder="City, Country">
                    </div>

                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-[#1b1b18] mb-2">Birth Date</label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                    </div>
                </div>

                <!-- Профессиональная информация -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-[#1b1b18] pb-2 border-b border-[#e3e3e0]">Professional Information</h2>

                    <div>
                        <label for="occupation" class="block text-sm font-medium text-[#1b1b18] mb-2">Occupation</label>
                        <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $user->occupation) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                    </div>

                    <div>
                        <label for="education" class="block text-sm font-medium text-[#1b1b18] mb-2">Education</label>
                        <input type="text" id="education" name="education" value="{{ old('education', $user->education) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-[#1b1b18] mb-2">Website</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $user->website) }}"
                               class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]"
                               placeholder="https://example.com">
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-[#1b1b18] mb-2">Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                                  class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]"
                                  placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>

                <!-- Социальные сети -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-[#1b1b18] pb-2 border-b border-[#e3e3e0]">Social Media</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-[#1b1b18] mb-2">
                                <i class="fab fa-facebook mr-1"></i> Facebook
                            </label>
                            <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $user->facebook) }}"
                                   class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        </div>

                        <div>
                            <label for="twitter" class="block text-sm font-medium text-[#1b1b18] mb-2">
                                <i class="fab fa-twitter mr-1"></i> Twitter
                            </label>
                            <input type="url" id="twitter" name="twitter" value="{{ old('twitter', $user->twitter) }}"
                                   class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        </div>

                        <div>
                            <label for="instagram" class="block text-sm font-medium text-[#1b1b18] mb-2">
                                <i class="fab fa-instagram mr-1"></i> Instagram
                            </label>
                            <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $user->instagram) }}"
                                   class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        </div>

                        <div>
                            <label for="github" class="block text-sm font-medium text-[#1b1b18] mb-2">
                                <i class="fab fa-github mr-1"></i> GitHub
                            </label>
                            <input type="url" id="github" name="github" value="{{ old('github', $user->github) }}"
                                   class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        </div>

                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-[#1b1b18] mb-2">
                                <i class="fab fa-linkedin mr-1"></i> LinkedIn
                            </label>
                            <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $user->linkedin) }}"
                                   class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003]">
                        </div>
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#e3e3e0]">
                    <button type="submit"
                            class="px-6 py-3 bg-[#1b1b18] text-white hover:bg-black rounded-lg font-medium transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>

                    <a href="{{ route('profile.show', $user) }}"
                       class="px-6 py-3 bg-white border border-[#e3e3e0] text-[#1b1b18] hover:bg-[#f5f5f4] rounded-lg font-medium transition-colors flex items-center justify-center text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
