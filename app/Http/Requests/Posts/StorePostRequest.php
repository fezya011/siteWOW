<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:255',
            'excerpt'  => 'nullable|string|max:500',
            'likes'    => 'nullable|integer|min:0',
            'comments' => 'nullable|integer|min:0',
        ];
    }
}
