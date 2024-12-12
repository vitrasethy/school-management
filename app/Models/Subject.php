<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject extends Model
{
    protected $fillable = ["name", 'department_id'];

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class)->withPivot('start_time', 'end_time');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'subject_id');
    }

    public function teacher($groupId): HasOne
    {
        return $this->hasOne(Teacher::class, 'subject_id')->where('group_id', $groupId);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'subject_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'subject_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
}
