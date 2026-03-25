<?php
// app/Http/Requests/Api/UpdatePostRequest.php

namespace App\Http\Requests\Api\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'content' => ['sometimes', 'string'],
            'category' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
