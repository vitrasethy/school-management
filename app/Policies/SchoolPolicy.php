<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super admin');
    }

    public function view(User $user, School $school): bool
    {
        if ($user->hasRole('super admin')) return true;



        $isSchoolAdmin = $user->role_id === 1;
        $isRelateCurrSchool = $user->school_id === $school->id;

        return $this->viewAny($user) || ($isRelateCurrSchool && $isSchoolAdmin);
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
