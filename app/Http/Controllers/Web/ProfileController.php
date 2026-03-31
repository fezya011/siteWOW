<?php
// app/Http/Controllers/Web/ProfileController.php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // Проверяем, может ли пользователь просматривать этот профиль
        if (Auth::id() !== $user->id && !Auth::user()?->role === 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('user.profile', [
            'user' => $user,
            'postsCount' => $user->posts()->count(),
            'userPosts' => $user->posts()->latest()->take(6)->get(),
            'photosCount' => 0,
            'commentsCount' => 0,
        ]);
    }

    public function edit()
    {
        return view('user.profileEdit', ['user' => auth()->user()]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());

        return redirect()->route('profile.show', $user)
            ->with('success', 'Profile updated successfully!');
    }
}
