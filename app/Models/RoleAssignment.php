<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RoleAssignment extends Model
{
    protected $fillable = [
        'user_id', 'role_id', 'role_assignmentable_type', 'role_assignmentable_id'
    ];

    public function roleAssignmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
