<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'School Admin']);
        Role::create(['name' => 'Department Admin']);
        Role::create(['name' => 'Teacher']);
        Role::create(['name' => 'Student']);
    }
}
