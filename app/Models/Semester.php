<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    protected $fillable = [
        'name',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'semester_id');
    }
}
