<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use function fake;

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
            $user->assignRole('student');
            $user->userAffiliations()->create([
                'faculty_id' => fake()->numberBetween(1, 10),
                'department_id' => fake()->numberBetween(1, 30),
            ]);
        });
        User::factory(30)->create()->each(function (User $user) {
            $user->assignRole('teacher');
            $user->userAffiliations()->create([
                'faculty_id' => fake()->numberBetween(1, 10),
                'department_id' => fake()->numberBetween(1, 30),
            ]);
        });
    }
}
