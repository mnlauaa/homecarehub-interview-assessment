<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'author_name'   => 'required|max:255',
            'body'          => 'required',
            'image'         => ['required', $this->hasFile('image') ? File::image() : '']
        ];
    }
}
