<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::insert([
            [
                'name' => 'Information Technology Engineering',
                'abbr' => 'ITE',
                'school_id' => 1,
            ],
            [
                'name' => 'Bio Engineering',
                'abbr' => 'BE',
                'school_id' => 1,
            ]
        ]);
    }
}
