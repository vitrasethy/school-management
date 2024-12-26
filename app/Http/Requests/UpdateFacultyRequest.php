<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:250',
            'abbr' => 'sometimes|string|max:5',
            'image_url' => 'sometimes|url',
        ];
    }
}
