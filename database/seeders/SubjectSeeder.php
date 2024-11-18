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
        $teacher1 = User::factory()->create([
            'role_id' => 4,
            'school_id' => 1,
            'department_id' => 1,
        ]);

        $teacher2 = User::factory()->create([
            'role_id' => 4,
            'school_id' => 1,
            'department_id' => 1,
        ]);

        $subject1 = Subject::create([
            'name' => 'Data Structures and Algorithms',
            'teacher_id' => $teacher1->id,
        ]);

        $subject2 = Subject::create([
            'name' => 'Backend Developer',
            'teacher_id' => $teacher2->id,
        ]);

        Group::find(1)->subjects()->attach([$subject1->id, $subject2->id]);
    }
}
