<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model
{
    protected $fillable = ['name'];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->withPivot('start_time', 'end_time');
    }
}
