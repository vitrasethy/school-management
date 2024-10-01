<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    protected $fillable = [
        'department_id',
        'name',
        'school_year',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
