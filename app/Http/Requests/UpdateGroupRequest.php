<?php

namespace App\Http\Requests;

use App\Enum\GroupYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'academic_year' => ['sometimes', 'string', 'regex:/^\d{4}-\d{4}$/'],
            'year' => ['sometimes', Rule::enum(GroupYear::class)],
            'semester' => ['sometimes', 'integer'],
            'department_id' => ['sometimes', 'exists:departments'],
        ];
    }
}
