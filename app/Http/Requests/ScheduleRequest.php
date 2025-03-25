<?php

namespace App\Http\Requests;

use App\Enum\Weekdays;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'weekdays' => ['required', Rule::enum(Weekdays::class)],
            'time' => ['required', 'date_format:H:i:s'],
            'subject_id' => ['required', 'exists:subjects'],
        ];
    }
}
