<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    public function run(): void
    {
        SchoolYear::insert([
            [
                'name' => '2024-2025',
            ],
            [
                'name' => '2025-2026',
            ],
            [
                'name' => '2026-2027',
            ],
            [
                'name' => '2027-2028',
            ],
            [
                'name' => '2028-2029',
            ],
            [
                'name' => '2029-2030',
            ],
        ]);
    }
}
