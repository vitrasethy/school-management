<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'score' => ['required', 'numeric'],
            'subject_id' => ['required', 'exists:subjects'],
            'activity_type_id' => ['required', 'exists:activity_types'],
        ];
    }
}
