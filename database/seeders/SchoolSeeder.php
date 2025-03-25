<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::insert([
            [
                'name' => 'Massachusetts Institute of Technology',
                'abbr' => 'MIT',
                'code' => '1',
            ],
            [
                'name' => 'Royal University of Phnom Penh',
                'abbr' => 'RUPP',
                'code' => '2',
            ],
            [
                'name' => 'University of Oxford',
                'abbr' => 'Oxon',
                'code' => '3',
            ],
        ]);
    }
}
