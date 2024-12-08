<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\Group;
use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view all groups');
    }

    public function view(User $user, Group $group): bool
    {
        if ($user->hasPermissionTo('view all groups')) return true;

        if (
            $user->hasPermissionTo('view all group by own department') &&
            $user->department_id === $group->department_id
        ) return true;

        return
            $user->hasPermissionTo('view own group') &&
            $user->whereRelation('groups', 'id', '=', $group->id)->exists();
    }

    public function viewByDepartment(User $user, Department $department): bool
    {
        if ($user->hasPermissionTo('view all groups')) return true;

        return
            $user->hasPermissionTo('view all group by own department') &&
            $user->department_id === $department->id;
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create group');
    }

    public function update(User $user, Group $group): bool
    {
        if ($user->hasPermissionTo('view all groups')) return true;

        return
            $user->hasPermissionTo('view all group by own department') &&
            $user->department_id === $group->department_id;
    }

    public function delete(User $user, Group $group): bool
    {
        if ($user->hasPermissionTo('view all groups')) return true;

        return
            $user->hasPermissionTo('view all group by own department') &&
            $user->department_id === $group->department_id;
    }
}
