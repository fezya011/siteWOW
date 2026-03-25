<?php
// app/Http/Requests/Api/UpdateProfileRequest.php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:20'],
            'location' => ['sometimes', 'nullable', 'string', 'max:255'],
            'occupation' => ['sometimes', 'nullable', 'string', 'max:255'],
            'education' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bio' => ['sometimes', 'nullable', 'string'],
            'website' => ['sometimes', 'nullable', 'url', 'max:255'],
            'birthdate' => ['sometimes', 'nullable', 'date'],
            'facebook' => ['sometimes', 'nullable', 'url', 'max:255'],
            'twitter' => ['sometimes', 'nullable', 'url', 'max:255'],
            'instagram' => ['sometimes', 'nullable', 'url', 'max:255'],
            'github' => ['sometimes', 'nullable', 'url', 'max:255'],
            'linkedin' => ['sometimes', 'nullable', 'url', 'max:255'],
            'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'The name must not exceed 255 characters.',
            'website.url' => 'Please provide a valid URL for the website.',
            'facebook.url' => 'Please provide a valid URL for Facebook profile.',
            'twitter.url' => 'Please provide a valid URL for Twitter profile.',
            'instagram.url' => 'Please provide a valid URL for Instagram profile.',
            'github.url' => 'Please provide a valid URL for GitHub profile.',
            'linkedin.url' => 'Please provide a valid URL for LinkedIn profile.',
            'birthdate.date' => 'Please provide a valid date format (YYYY-MM-DD).',
            'avatar.image' => 'The avatar must be an image file.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif.',
            'avatar.max' => 'The avatar must not be larger than 2MB.',
        ];
    }
}
