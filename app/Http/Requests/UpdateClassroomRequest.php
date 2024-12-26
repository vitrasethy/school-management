<?php

namespace App\Http\Requests;

class UpdateClassroomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:250',
            'subject_id' => 'sometimes|exists:subjects,id',
            'weekday' => 'sometimes|string',
            'start_time' => 'sometimes|date_format:H:i:s',
            'end_time' => 'sometimes|date_format:H:i:s',
        ];
    }
}
