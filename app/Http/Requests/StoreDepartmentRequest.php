<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'faculty_id' => 'required|exists:faculties,id',
            'image_url' => 'required|url',
            'abbr' => 'required|string|max:5',
        ];
    }
}
