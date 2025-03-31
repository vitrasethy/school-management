<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $fillable = [
        'department_id', 'name', 'year_id', 'school_year_id', 'semester_id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this
            ->belongsToMany(Subject::class)
            ->withPivot(['teacher_id', 'pass_score']);
    }

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function teacher(): BelongsToMany
    {
        return $this
            ->belongsToMany(Subject::class)
            ->withPivot(['teacher_id', 'pass_score'])
            ->wherePivot('teacher_id', Auth::id());
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_group', 'group_id', 'activity_id');
    }
}
