<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('user.profile', [
            'user'          => $user,
            'postsCount'    => $user->posts()->count(),
            'userPosts'     => $user->posts()->latest()->take(6)->get(),
            'photosCount'   => 0,
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
