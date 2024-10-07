<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'School Admin'],
            ['name' => 'Department Admin'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
        ]);

        User::factory(1)->create(['is_super_admin' => true, 'email' => 'admin@admin.com']);
    }
}
