<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'department_id', 'name', 'year', 'academic_year', 'semester',
    ];

    public function userAffiliations(): HasMany
    {
        return $this->hasMany(UserAffiliation::class, 'group_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_group', 'group_id', 'student_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->withPivot('teacher_id');
    }
}
