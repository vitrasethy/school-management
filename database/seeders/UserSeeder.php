<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)
            ->create([
                'email' => 'admin@admin.com',
            ]);

        User::find(1)->assignRole('super admin');

        User::factory(50)->create()->each(function (User $user) {
            return $user->assignRole('student');
        });
        User::factory(30)->create()->each(function (User $user) {
            return $user->assignRole('teacher');
        });
    }
}
