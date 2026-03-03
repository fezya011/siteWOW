<?php

namespace App\Service\AuthServices;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    public function execute(Request $request): User
    {
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ];

        if ($avatar = $request->file('avatar')) {
            $fileName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('storage/avatars'), $fileName);
            $data['avatar'] = $fileName;
        }

        return User::create($data);
    }
}
