<?php

namespace App\Http\Requests;

class ResponseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'form_id' => ['required', 'exists:forms'],
        ];
    }
}
