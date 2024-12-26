<?php

namespace App\Observers;

use App\Models\Faculty;

class FacultyObserver
{
    public function created(Faculty $faculty): void
    {
        $faculty->update(['code' => $faculty->id]);
    }
}
