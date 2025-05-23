<?php

namespace App\Http\Requests;

class BulkStoreAnswerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'answers' => ['required', 'array'],
            'answers.*.question_id' => ['required', 'exists:questions,id'],
            'answers.*.option_ids' => ['nullable', 'array'],
            'answers.*.option_ids.*' => ['required', 'exists:options,id'],
            'answers.*.text' => ['nullable', 'string'],
            //'user_id' => ['required', 'exists:users'],
        ];
    }
}
