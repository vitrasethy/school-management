<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Group $group): bool
    {
        return $user->can('viewAny', $group->department);
    }

    public function view(User $user, Group $group): bool
    {
        $isTeachOrStudent = $user->role_id === 3 || $user->role_id === 4;
        $isRelateCurrGroup = $user->school_id === $group->department->school->id;

        return $this->viewAny($user, $group) || ($isTeachOrStudent && $isRelateCurrGroup);
    }

    public function create(User $user, Group $group): bool
    {
        return $user->can('viewAny', $group->department) && $user->is_super_admin === false;
    }

    public function update(User $user, Group $group): bool
    {
        return $user->can('viewAny', $group->department);
    }

    public function delete(User $user, Group $group): bool
    {
        return $user->can('viewAny', $group->department);
    }
}
