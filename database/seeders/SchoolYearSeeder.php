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
                'started_at' => '2024-09-01',
                'finished_at' => '2025-06-01',
            ],
            [
                'name' => '2025-2026',
                'started_at' => '2025-09-01',
                'finished_at' => '2026-06-01',
            ],
            [
                'name' => '2026-2027',
                'started_at' => '2026-09-01',
                'finished_at' => '2027-06-01',
            ],
            [
                'name' => '2027-2028',
                'started_at' => '2027-09-01',
                'finished_at' => '2028-06-01',
            ],
            [
                'name' => '2028-2029',
                'started_at' => '2028-09-01',
                'finished_at' => '2029-06-01',
            ],
            [
                'name' => '2029-2030',
                'started_at' => '2029-09-01',
                'finished_at' => '2030-06-01',
            ],
        ]);
    }
}
