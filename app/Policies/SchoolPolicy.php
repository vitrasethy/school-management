<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_super_admin;
    }

    public function view(User $user, School $school): bool
    {
        return $school->roleAssignments()->whereUserId($user->id)->exists();
    }

    public function update(User $user, School $school): bool
    {
        return $this->view($user, $school);
    }

    public function delete(User $user, School $school): bool
    {
        return $this->view($user, $school);
    }
}
