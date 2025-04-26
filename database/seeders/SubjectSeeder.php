<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::create([
            'name' => 'Introduction to Programming',
            'abbr' => 'ITP',
            'department_id' => 1,
        ]);
        Subject::create([
            'name' => 'Computer Networks',
            'abbr' => 'CN',
            'department_id' => 1,
        ]);

        Subject::create([
            'name' => 'Embedded C Programming',
            'abbr' => 'ECP',
            'department_id' => 2,
        ]);
        Subject::create([
            'name' => 'Digital Logic Design',
            'abbr' => 'DLD',
            'department_id' => 2,
        ]);

        Subject::create([
            'name' => 'Advanced Java Programming',
            'abbr' => 'AJP',
            'department_id' => 3,
        ]);
        Subject::create([
            'name' => 'Agile Software Development',
            'abbr' => 'ASD',
            'department_id' => 3,
        ]);

        Subject::create([
            'name' => 'Data Mining',
            'abbr' => 'DM',
            'department_id' => 4,
        ]);
        Subject::create([
            'name' => 'Statistical Analysis',
            'abbr' => 'SA',
            'department_id' => 4,
        ]);

        Subject::create([
            'name' => 'Cryptography',
            'abbr' => 'CRY',
            'department_id' => 5,
        ]);
        Subject::create([
            'name' => 'Ethical Hacking',
            'abbr' => 'EH',
            'department_id' => 5,
        ]);

        Subject::create([
            'name' => 'Neural Networks',
            'abbr' => 'NN',
            'department_id' => 6,
        ]);
        Subject::create([
            'name' => 'Deep Learning',
            'abbr' => 'DL',
            'department_id' => 6,
        ]);

        Subject::create([
            'name' => 'Business Process Modeling',
            'abbr' => 'BPM',
            'department_id' => 7,
        ]);
        Subject::create([
            'name' => 'Health Data Management',
            'abbr' => 'HDM',
            'department_id' => 7,
        ]);

        Subject::create([
            'name' => 'Wireless Communications',
            'abbr' => 'WC',
            'department_id' => 8,
        ]);
        Subject::create([
            'name' => 'Distributed Systems',
            'abbr' => 'DSY',
            'department_id' => 8,
        ]);

        Subject::create([
            'name' => 'Digital Photography',
            'abbr' => 'DP',
            'department_id' => 9,
        ]);
        Subject::create([
            'name' => '3D Animation',
            'abbr' => '3DA',
            'department_id' => 9,
        ]);

        Subject::create([
            'name' => 'Game Engine Programming',
            'abbr' => 'GEP',
            'department_id' => 10,
        ]);
        Subject::create([
            'name' => 'Interactive Game Design',
            'abbr' => 'IGD',
            'department_id' => 10,
        ]);

        Subject::create([
            'name' => 'Industrial Automation',
            'abbr' => 'IA',
            'department_id' => 11,
        ]);
        Subject::create([
            'name' => 'Robotics Programming',
            'abbr' => 'RP',
            'department_id' => 11,
        ]);
    }
}
