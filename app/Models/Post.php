<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'caption',
        'image',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
