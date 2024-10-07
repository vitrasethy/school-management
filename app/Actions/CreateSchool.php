<?php

namespace App\Actions;

use App\Models\Role;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class CreateSchool
{
    public function execute(array $validated_data)
    {
        $school = School::create($validated_data);

        $role = Role::where('name', 'School Admin')->first();

        Auth::user()->roles()->attach($role->id, ['school_id' => $school->id]);

        return $school;
    }
}
