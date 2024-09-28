<?php

namespace App\Policies;

use App\Models\CategoryType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryTypePolicy
{
    public function admin(User $user): bool
    {
        return true;
    }
}
