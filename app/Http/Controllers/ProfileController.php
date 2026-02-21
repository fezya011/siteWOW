<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $postsCount = $user->posts()->count();
        $userPosts = $user->posts()->latest()->take(6)->get();

        // Заглушки для статистики
        $photosCount = 0; // Можно добавить позже
        $commentsCount = 0; // Можно добавить позже

        return view('user.profile', compact('user', 'postsCount', 'photosCount', 'commentsCount', 'userPosts'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.profileEdit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'birthdate' => 'nullable|date',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('profile.show', $user)
            ->with('success', 'Profile updated successfully!');
    }
}
