<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        CategoryType::insert([
            ['name' => 'School'],
            ['name' => 'Department'],
            ['name' => 'Group']
        ]);

        User::factory(1)->create(['is_super_admin' => true, 'email' => 'admin@admin.com']);

        Category::factory(10)->create();
    }
}
