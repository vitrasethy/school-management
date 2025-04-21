<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'duration' => ['nullable', 'integer'],
            'weight' => ['required', 'integer'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'due_at' => ['required', 'date_format:Y-m-d H:i'],
            'group_ids' => ['required', 'array'],
            'group_ids.*' => ['required', 'exists:groups,id'],
            'activity_type_id' => ['required', 'exists:activity_types,id'],
            'title' => ['required'],
            'description' => ['nullable'],
            'questions' => ['required', 'array'],
            'questions.*.name' => ['required', 'string'],
            'questions.*.type' => ['required', 'string'],
            'questions.*.is_require' => ['required', 'boolean'],
            'questions.*.correct_answer' => ['nullable', 'string'],
            'questions.*.points' => ['required', 'integer'],
            'questions.*.options' => ['nullable', 'array'],
            'questions.*.options.*.name' => ['required', 'string'],
            'questions.*.options.*.is_correct' => ['required', 'boolean'],
        ];
    }
}
