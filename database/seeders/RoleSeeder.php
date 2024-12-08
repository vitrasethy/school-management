<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'super admin']);
        Role::create(['name' => 'school admin']);
        Role::create(['name' => 'department admin']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);
    }
}
