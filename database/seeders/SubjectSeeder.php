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
            'name' => 'Data Structures and Algorithms',
        ]);

        $subject2 = Subject::create([
            'name' => 'Backend Developer',
        ]);

        Group::find(1)->subjects()->attach([$subject1->id, $subject2->id]);
    }
}
