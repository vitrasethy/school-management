<?php

namespace App\Http\Requests;

use App\Enum\GroupYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'school_year' => ['required', 'string', 'regex:/^\d{4}-\d{4}$/'],
            'code' => ['required', 'string', 'max:6'],
            'year' => ['required', Rule::enum(GroupYear::class)],
            'department_id' => ['required', 'exists:departments']
        ];
    }
}
