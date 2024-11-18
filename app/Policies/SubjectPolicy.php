<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_super_admin;
    }

    public function view(User $user, Subject $subject): bool
    {
        return $this->viewAny($user) || $subject->whereRelation('groups', 'department_id', '=', $user->department_id)->exists();
    }

    public function create(User $user, Subject $subject): bool
    {
        $isDepartAdmin =
            $subject->whereRelation('groups', 'department_id', '=', $user->department_id)->exists() && $user->whereRoleId(2)->exists();

        return $this->viewAny($user) || $isDepartAdmin;
    }

    public function update(User $user, Subject $subject): bool
    {
        return $this->create($user, $subject);
    }

    public function delete(User $user, Subject $subject): bool
    {
        return $this->create($user, $subject);
    }
}
