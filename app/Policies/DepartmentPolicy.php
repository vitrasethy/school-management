<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Department $department): bool
    {
        return $user->can('view', $department->school);
    }

    public function view(User $user, Department $department): bool
    {
        $is_school_admin = $user->can('view', $department->school);
        $is_department_admin = $department->roleAssignments()->whereUserId($user->id)->exists();

        return $is_school_admin || $is_department_admin;
    }

    public function create(User $user, Department $department): bool
    {
        return $user->can('view', $department->school) && $user->is_super_admin === false;
    }

    public function update(User $user, Department $department): bool
    {
        return $user->can('view', $department->school);
    }

    public function delete(User $user, Department $department): bool
    {
        return $user->can('view', $department->school);
    }
}
