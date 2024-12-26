<?php

namespace App\Http\Requests;

class UpdateSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:250',
            'group_id' => 'sometimes|exists:groups,id',
            'teacher_id' => 'sometimes|exists:users,id',
        ];
    }
}
