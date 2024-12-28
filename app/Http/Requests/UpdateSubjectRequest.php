<?php

namespace App\Http\Requests;

class UpdateSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:250',
            'department_id' => 'sometimes|exists:departments,id',
            'abbr' => 'sometimes|string|max:5',
        ];
    }
}
