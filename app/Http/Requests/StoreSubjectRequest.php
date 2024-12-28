<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'department_id' => 'required|exists:departments,id',
            'abbr' => 'required|string|max:5',
        ];
    }
}
