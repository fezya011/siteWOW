<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens ,HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'location',
        'occupation',
        'education',
        'bio',
        'website',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'github',
        'linkedin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', $this->name, 2);
        return strtoupper(substr($parts[0], 0, 1) . substr($parts[1] ?? $parts[0], 1, 1));
    }
}
