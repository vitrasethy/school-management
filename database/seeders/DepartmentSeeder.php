<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'name' => 'Software Development',
            'abbr' => 'SD',
            'faculty_id' => 1,
            'image_url' => 'https://example.com/images/sd.jpg',
        ]);
        Department::create([
            'name' => 'Network and Infrastructure',
            'abbr' => 'NI',
            'faculty_id' => 1,
            'image_url' => 'https://example.com/images/ni.jpg',
        ]);

        Department::create([
            'name' => 'Embedded Systems',
            'abbr' => 'ES',
            'faculty_id' => 2,
            'image_url' => 'https://example.com/images/es.jpg',
        ]);
        Department::create([
            'name' => 'Computer Architecture',
            'abbr' => 'CA',
            'faculty_id' => 2,
            'image_url' => 'https://example.com/images/ca.jpg',
        ]);

        Department::create([
            'name' => 'Enterprise Software',
            'abbr' => 'ESW',
            'faculty_id' => 3,
            'image_url' => 'https://example.com/images/esw.jpg',
        ]);
        Department::create([
            'name' => 'Mobile Application Development',
            'abbr' => 'MAD',
            'faculty_id' => 3,
            'image_url' => 'https://example.com/images/mad.jpg',
        ]);

        Department::create([
            'name' => 'Big Data Analytics',
            'abbr' => 'BDA',
            'faculty_id' => 4,
            'image_url' => 'https://example.com/images/bda.jpg',
        ]);
        Department::create([
            'name' => 'Data Engineering',
            'abbr' => 'DE',
            'faculty_id' => 4,
            'image_url' => 'https://example.com/images/de.jpg',
        ]);

        Department::create([
            'name' => 'Information Security',
            'abbr' => 'ISY',
            'faculty_id' => 5,
            'image_url' => 'https://example.com/images/isy.jpg',
        ]);
        Department::create([
            'name' => 'Digital Forensics',
            'abbr' => 'DF',
            'faculty_id' => 5,
            'image_url' => 'https://example.com/images/df.jpg',
        ]);

        Department::create([
            'name' => 'Machine Learning',
            'abbr' => 'ML',
            'faculty_id' => 6,
            'image_url' => 'https://example.com/images/ml.jpg',
        ]);
        Department::create([
            'name' => 'Natural Language Processing',
            'abbr' => 'NLP',
            'faculty_id' => 6,
            'image_url' => 'https://example.com/images/nlp.jpg',
        ]);

        Department::create([
            'name' => 'Business Information Systems',
            'abbr' => 'BIS',
            'faculty_id' => 7,
            'image_url' => 'https://example.com/images/bis.jpg',
        ]);
        Department::create([
            'name' => 'Health Informatics',
            'abbr' => 'HI',
            'faculty_id' => 7,
            'image_url' => 'https://example.com/images/hi.jpg',
        ]);

        Department::create([
            'name' => 'Wireless Networks',
            'abbr' => 'WN',
            'faculty_id' => 8,
            'image_url' => 'https://example.com/images/wn.jpg',
        ]);
        Department::create([
            'name' => 'Cloud Computing',
            'abbr' => 'CC',
            'faculty_id' => 8,
            'image_url' => 'https://example.com/images/cc.jpg',
        ]);

        Department::create([
            'name' => 'Digital Media',
            'abbr' => 'DM',
            'faculty_id' => 9,
            'image_url' => 'https://example.com/images/dm.jpg',
        ]);
        Department::create([
            'name' => 'Animation Technology',
            'abbr' => 'AT',
            'faculty_id' => 9,
            'image_url' => 'https://example.com/images/at.jpg',
        ]);

        Department::create([
            'name' => 'Game Programming',
            'abbr' => 'GP',
            'faculty_id' => 10,
            'image_url' => 'https://example.com/images/gp.jpg',
        ]);
        Department::create([
            'name' => 'Game Design',
            'abbr' => 'GD',
            'faculty_id' => 10,
            'image_url' => 'https://example.com/images/gdd.jpg',
        ]);

        Department::create([
            'name' => 'Robotics Engineering',
            'abbr' => 'RE',
            'faculty_id' => 11,
            'image_url' => 'https://example.com/images/re.jpg',
        ]);
        Department::create([
            'name' => 'Automation Systems',
            'abbr' => 'AS',
            'faculty_id' => 11,
            'image_url' => 'https://example.com/images/as.jpg',
        ]);
    }
}
