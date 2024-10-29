<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class School extends Model
{
    protected $fillable = [
        'name',
        'khmer_name'
    ];

    public function roleAssignments(): MorphMany
    {
        return $this->morphMany(RoleAssignment::class, 'roleAssignmentable');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'school_id');
    }
}
