<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Department extends Model
{
    protected $fillable = [
        'school_id',
        'name',
    ];

    public function roleAssignments(): MorphMany
    {
        return $this->morphMany(RoleAssignment::class, 'roleAssignmentable');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
