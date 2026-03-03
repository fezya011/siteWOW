<?php

namespace App\Http\Requests\Posts;

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
            'title'    => 'required|max:255',
            'content'  => 'required',
            'category' => 'required',
            'excerpt'  => 'nullable',
        ];
    }
}
