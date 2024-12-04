<?php

namespace App\Http\Requests;

class QuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_id' => ['required', 'exists:forms'],
            'name' => ['required'],
            'type' => ['required'],
            'is_required' => ['boolean'],
        ];
    }
}
