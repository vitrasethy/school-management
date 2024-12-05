<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::insert([
            [
                'name' => 'M1',
                'department_id' => 1,
                'school_year' => '2024-2025',
                'year' => 1,
                'code' => '123456',
            ],
            [
                'name' => 'M2',
                'department_id' => 1,
                'year' => 1,
                'school_year' => '2024-2025',
                'code' => '123457',
            ],
            [
                'name' => 'M3',
                'department_id' => 1,
                'year' => 1,
                'school_year' => '2024-2025',
                'code' => '123458',
            ],
        ]);
    }
}
