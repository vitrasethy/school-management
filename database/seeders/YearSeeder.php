<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    public function run(): void
    {
        Year::insert([
            [
                'name' => 1,
            ],
            [
                'name' => 2,
            ],
            [
                'name' => 3,
            ],
            [
                'name' => 4,
            ],
        ]);
    }
}
