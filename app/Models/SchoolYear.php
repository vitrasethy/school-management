<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolYear extends Model
{
    protected $fillable = [
        'name',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'school_year_id');
    }
}
