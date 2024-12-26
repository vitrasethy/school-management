<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver
{
    public function created(Department $department): void
    {
        $department->update(['code' => $department->faculty_id + $department->id]);
    }
}
