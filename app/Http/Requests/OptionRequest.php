<?php

namespace App\Http\Requests;

class OptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question_id' => ['required', 'exists:questions'],
            'name' => ['required'],
        ];
    }
}
