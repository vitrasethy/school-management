<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    protected $fillable = ['name', 'image', 'abbr', 'code'];

    protected $attributes = [
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx_DVDju34ygSyxCFLiCiat_DQoyUusJHXdw&s'
    ];

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'school_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'school_id');
    }
}
