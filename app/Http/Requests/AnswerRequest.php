<?php

namespace App\Http\Requests;

class AnswerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'response_id' => ['required', 'exists:responses'],
            'question_id' => ['required', 'exists:questions'],
            'option_id' => ['required', 'exists:options'],
            'text' => ['required'],
        ];
    }
}
