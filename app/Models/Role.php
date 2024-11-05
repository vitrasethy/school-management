<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    protected $fillable = ['name'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'role_id');
    }
}
