<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name', 'school_id', 'abbr', 'code'];

    protected $attributes = [
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx_DVDju34ygSyxCFLiCiat_DQoyUusJHXdw&s'
    ];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'department_id');
    }
}
