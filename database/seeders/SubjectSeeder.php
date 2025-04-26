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
            'image_url' => 'https://example.com/images/itp.jpg',
        ]);
        Subject::create([
            'name' => 'Computer Networks',
            'abbr' => 'CN',
            'department_id' => 1,
            'image_url' => 'https://example.com/images/cn.jpg',
        ]);

        Subject::create([
            'name' => 'Embedded C Programming',
            'abbr' => 'ECP',
            'department_id' => 2,
            'image_url' => 'https://example.com/images/ecp.jpg',
        ]);
        Subject::create([
            'name' => 'Digital Logic Design',
            'abbr' => 'DLD',
            'department_id' => 2,
            'image_url' => 'https://example.com/images/dld.jpg',
        ]);

        Subject::create([
            'name' => 'Advanced Java Programming',
            'abbr' => 'AJP',
            'department_id' => 3,
            'image_url' => 'https://example.com/images/ajp.jpg',
        ]);
        Subject::create([
            'name' => 'Agile Software Development',
            'abbr' => 'ASD',
            'department_id' => 3,
            'image_url' => 'https://example.com/images/asd.jpg',
        ]);

        Subject::create([
            'name' => 'Data Mining',
            'abbr' => 'DM',
            'department_id' => 4,
            'image_url' => 'https://example.com/images/dm.jpg',
        ]);
        Subject::create([
            'name' => 'Statistical Analysis',
            'abbr' => 'SA',
            'department_id' => 4,
            'image_url' => 'https://example.com/images/sa.jpg',
        ]);

        Subject::create([
            'name' => 'Cryptography',
            'abbr' => 'CRY',
            'department_id' => 5,
            'image_url' => 'https://example.com/images/cry.jpg',
        ]);
        Subject::create([
            'name' => 'Ethical Hacking',
            'abbr' => 'EH',
            'department_id' => 5,
            'image_url' => 'https://example.com/images/eh.jpg',
        ]);

        Subject::create([
            'name' => 'Neural Networks',
            'abbr' => 'NN',
            'department_id' => 6,
            'image_url' => 'https://example.com/images/nn.jpg',
        ]);
        Subject::create([
            'name' => 'Deep Learning',
            'abbr' => 'DL',
            'department_id' => 6,
            'image_url' => 'https://example.com/images/dl.jpg',
        ]);

        Subject::create([
            'name' => 'Business Process Modeling',
            'abbr' => 'BPM',
            'department_id' => 7,
            'image_url' => 'https://example.com/images/bpm.jpg',
        ]);
        Subject::create([
            'name' => 'Health Data Management',
            'abbr' => 'HDM',
            'department_id' => 7,
            'image_url' => 'https://example.com/images/hdm.jpg',
        ]);

        Subject::create([
            'name' => 'Wireless Communications',
            'abbr' => 'WC',
            'department_id' => 8,
            'image_url' => 'https://example.com/images/wc.jpg',
        ]);
        Subject::create([
            'name' => 'Distributed Systems',
            'abbr' => 'DSY',
            'department_id' => 8,
            'image_url' => 'https://example.com/images/dsy.jpg',
        ]);

        Subject::create([
            'name' => 'Digital Photography',
            'abbr' => 'DP',
            'department_id' => 9,
            'image_url' => 'https://example.com/images/dp.jpg',
        ]);
        Subject::create([
            'name' => '3D Animation',
            'abbr' => '3DA',
            'department_id' => 9,
            'image_url' => 'https://example.com/images/3da.jpg',
        ]);

        Subject::create([
            'name' => 'Game Engine Programming',
            'abbr' => 'GEP',
            'department_id' => 10,
            'image_url' => 'https://example.com/images/gep.jpg',
        ]);
        Subject::create([
            'name' => 'Interactive Game Design',
            'abbr' => 'IGD',
            'department_id' => 10,
            'image_url' => 'https://example.com/images/igd.jpg',
        ]);

        Subject::create([
            'name' => 'Industrial Automation',
            'abbr' => 'IA',
            'department_id' => 11,
            'image_url' => 'https://example.com/images/ia.jpg',
        ]);
        Subject::create([
            'name' => 'Robotics Programming',
            'abbr' => 'RP',
            'department_id' => 11,
            'image_url' => 'https://example.com/images/rp.jpg',
        ]);
    }
}
