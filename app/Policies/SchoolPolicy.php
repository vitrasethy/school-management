<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function view(User $user, School $school): bool
    {
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
