<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolYearSeeder::class,
            YearSeeder::class,
            SemesterSeeder::class,
            ActivityTypeSeeder::class,
            FacultySeeder::class,
            RoleSeeder::class,
            DepartmentSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            //GroupSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
