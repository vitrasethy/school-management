<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    protected $fillable = [
        'title',
        'description',
        'activity_id',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'form_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'form_id');
    }
}
