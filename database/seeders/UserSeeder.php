<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)->create(['is_super_admin' => true, 'email' => 'admin@admin.com']);
    }
}
