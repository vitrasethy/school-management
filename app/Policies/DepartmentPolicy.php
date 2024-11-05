<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    public function viewAny(User $user, Department $department): bool
    {
        return $user->can('view', $department->school);
    }

    public function view(User $user, Department $department): bool
    {
        $isDepartAdmin = $user->role_id === 2;
        $isRelateCurrDepart = $user->school_id === $department->school_id;

        return $this->viewAny($user, $department) || ($isDepartAdmin && $isRelateCurrDepart);
    }

    public function create(User $user, Department $department): bool
    {
        return $this->view($user, $department) && $user->is_super_admin === false;
    }

    public function update(User $user, Department $department): bool
    {
        return $this->view($user, $department);
    }

    public function delete(User $user, Department $department): bool
    {
        return $this->view($user, $department);
    }
}
