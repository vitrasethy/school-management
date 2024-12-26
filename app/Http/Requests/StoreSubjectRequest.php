<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'group_id' => 'required|exists:groups,id',
            'teacher_id' => 'required|exists:users,id',
        ];
    }
}
