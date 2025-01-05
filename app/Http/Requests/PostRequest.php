<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'caption' => ['required', 'string'],
            'subject_id' => ['required', 'exists:subjects,id'],
        ];
    }
}
