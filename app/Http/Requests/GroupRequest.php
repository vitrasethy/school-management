<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'school_year' => ['required', 'string', 'regex:/^\d{4}-\d{4}$/']
        ];
    }
}
