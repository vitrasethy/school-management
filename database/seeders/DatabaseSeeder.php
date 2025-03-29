<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
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

        $faculty = Faculty::create([
            'name' => 'Test',
            'abbr' => 'test',
            'image_url' => 'https://example.com/images/itc.jpg',
        ]);

        Department::create([
            'faculty_id' => $faculty->id,
            'name' => 'Test',
            'abbr' => 'test',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
    }
}
