<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::insert([
            ['name' => 'Massachusetts Institute of Technology'],
            ['name' => 'Royal University of Phnom Penh'],
            ['name' => 'University of Oxford'],
        ]);
    }
}
