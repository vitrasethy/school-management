<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        Semester::insert([
            [
                'name' => 'Semester 1',
            ],
            [
                'name' => 'Semester 2',
            ],
        ]);
    }
}
