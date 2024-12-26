<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:250',
            'faculty_id' => 'sometimes|exists:faculties,id',
            'image_url' => 'sometimes|url',
            'abbr' => 'sometimes|string|max:5',
        ];
    }
}
