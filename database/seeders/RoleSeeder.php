<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'School Admin'],
            ['name' => 'Department Admin'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
        ]);
    }
}
