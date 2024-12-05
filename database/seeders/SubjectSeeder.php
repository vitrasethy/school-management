<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subject1 = Subject::create([
            'department_id' => 1,
            'name' => 'Data Structures and Algorithms',
        ]);

        $subject2 = Subject::create([
            'department_id' => 1,
            'name' => 'Backend Developer',
        ]);

    }
}
