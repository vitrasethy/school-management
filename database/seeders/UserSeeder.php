<?php

namespace Database\Seeders;

use App\Models\Department;
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

            $facultyId = fake()->numberBetween(1, 10);
            $departmentIds = Department::where('faculty_id', $facultyId)->pluck('id');

            $user->userAffiliations()->create([
                'faculty_id' => $facultyId,
                'department_id' => fake()->randomElement($departmentIds),
            ]);
        });
        User::factory(30)->create()->each(function (User $user) {
            $user->assignRole('teacher');
            $facultyId = fake()->numberBetween(1, 10);
            $departmentIds = Department::where('faculty_id', $facultyId)->pluck('id');

            $user->userAffiliations()->create([
                'faculty_id' => $facultyId,
                'department_id' => fake()->randomElement($departmentIds),
            ]);
        });
    }
}
