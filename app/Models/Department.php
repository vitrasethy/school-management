<?php

namespace App\Models;

use App\Observers\DepartmentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(DepartmentObserver::class)]
class Department extends Model
{
    protected $fillable = ['code', 'faculty_id', 'name', 'image_url', 'abbr'];

    protected $attributes = [
        'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx_DVDju34ygSyxCFLiCiat_DQoyUusJHXdw&s',
    ];

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function userAffiliations(): HasMany
    {
        return $this->hasMany(UserAffiliation::class, 'department_id');
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'department_id');
    }
}
