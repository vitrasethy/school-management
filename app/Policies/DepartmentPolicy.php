<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view all departments');
    }

    public function view(User $user, Department $department): bool
    {
        if ($user->hasPermissionTo('view all departments')) return true;

        return
            $user->department_id === $department->id &&
            $user->hasPermissionTo('view own department');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create department');
    }

    public function update(User $user, Department $department): bool
    {
        if ($user->hasPermissionTo('edit all department')) return true;

        return
            $user->department_id === $department->id &&
            $user->hasPermissionTo('edit own departments');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete department');
    }
}
