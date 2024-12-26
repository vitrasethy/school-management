<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAffiliationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'faculty_id' => 'sometimes|exists:faculties,id',
            'department_id' => 'sometimes|exists:departments,id',
            'group_id' => 'sometimes|exists:groups,id',
        ];
    }
}
