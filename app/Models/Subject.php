<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'department_id', 'name', 'abbr',
    ];

    protected $attributes = [
        'abbr' => 'N/A',
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withPivot('teacher_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
