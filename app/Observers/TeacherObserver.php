<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Models\User;

class TeacherObserver
{
    public function created(Teacher $teacher): void
    {
        User::find($teacher->user_id)->assignRole('teacher');
    }
}
