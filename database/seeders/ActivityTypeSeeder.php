<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    public function run(): void
    {
        ActivityType::create(['name' => 'assignment']);
        ActivityType::create(['name' => 'mid-term']);
        ActivityType::create(['name' => 'final']);
    }
}
