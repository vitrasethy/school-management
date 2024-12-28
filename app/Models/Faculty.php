<?php

namespace App\Models;

use App\Observers\FacultyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(FacultyObserver::class)]
class Faculty extends Model
{
    protected $fillable = [
        'name', 'abbr', 'image_url', 'code',
    ];

    protected $attributes = [
        'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
    ];

    public function userAffiliations(): HasMany
    {
        return $this->hasMany(UserAffiliation::class, 'faculty_id');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'faculty_id');
    }
}
