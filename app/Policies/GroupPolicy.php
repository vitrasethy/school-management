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
        return $user->can('view', $group->department) || $group->roleAssignments()->whereUserId($user->id)->exists();
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
