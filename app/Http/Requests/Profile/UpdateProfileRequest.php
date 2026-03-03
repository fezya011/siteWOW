<?php

namespace App\Http\Requests\Profile;

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
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'location'   => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'education'  => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'website'    => 'nullable|url|max:255',
            'birthdate'  => 'nullable|date',
            'facebook'   => 'nullable|url|max:255',
            'twitter'    => 'nullable|url|max:255',
            'instagram'  => 'nullable|url|max:255',
            'github'     => 'nullable|url|max:255',
            'linkedin'   => 'nullable|url|max:255',
        ];
    }
}
