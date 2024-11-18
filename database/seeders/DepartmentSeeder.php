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
                'name' => 'ITE',
                'school_id' => 1,
            ],
            [
                'name' => 'DSE',
                'school_id' => 1,
            ]
        ]);
    }
}
