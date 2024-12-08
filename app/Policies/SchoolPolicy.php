<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view all schools');
    }

    public function view(User $user, School $school): bool
    {
        if ($user->hasPermissionTo('view all schools')) return true;

        return
            $user->school_id === $school->id &&
            $user->hasPermissionTo('view own school');
    }

    public function update(User $user, School $school): bool
    {
        if ($user->hasPermissionTo('edit all schools')) return true;

        return
            $user->school_id === $school->id &&
            $user->hasPermissionTo('edit own school');
    }

    public function delete(User $user, School $school): bool
    {
        if ($user->hasPermissionTo('delete all school')) return true;

        return
            $user->school_id === $school->id &&
            $user->hasPermissionTo('delete own school');
    }
}
