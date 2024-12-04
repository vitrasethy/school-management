<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'subject_id' => ['required', 'exists:subjects']
        ];
    }
}
