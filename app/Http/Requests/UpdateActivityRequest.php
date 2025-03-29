<?php

namespace App\Http\Requests;

class UpdateActivityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'duration' => ['nullable', 'integer'],
            'due_at' => ['required', 'date_format:Y-m-d H:i'],
            'title' => ['required'],
            'description' => ['nullable'],
            'questions' => ['required', 'array'],
            'questions.*.id' => ['required', 'exists:questions,id'],
            'questions.*.name' => ['required', 'string'],
            'questions.*.type' => ['required', 'string'],
            'questions.*.is_require' => ['required', 'boolean'],
            'questions.*.correct_answer' => ['nullable', 'string'],
            'questions.*.points' => ['required', 'integer'],
            'questions.*.options' => ['nullable', 'array'],
            'questions.*.options.*.id' => ['required', 'exists:options,id'],
            'questions.*.options.*.name' => ['required', 'string'],
            'questions.*.options.*.is_correct' => ['required', 'boolean'],
        ];
    }
}
