<?php

namespace App\Models;

use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    //protected function teacher(): Attribute
    //{
    //    return Attribute::make(
    //        get: fn ($value, array $attributes) => new UserResource,
    //    );
    //}

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withPivot('teacher_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
