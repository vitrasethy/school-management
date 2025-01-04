<?php

namespace App\Http\Requests;

use App\Enum\GroupYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'academic_year' => ['required', 'string', 'regex:/^\d{4}-\d{4}$/'],
            'year' => ['required', Rule::enum(GroupYear::class)],
            'semester' => ['required', 'integer'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }
}
