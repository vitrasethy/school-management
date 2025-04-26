<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run()
    {
        Faculty::create([
            'name' => 'Information Technology and Computer Science',
            'abbr' => 'ITC',
            'image_url' => 'https://example.com/images/itc.jpg',
        ]);
        Faculty::create([
            'name' => 'Computer Engineering',
            'abbr' => 'CE',
            'image_url' => 'https://example.com/images/ce.jpg',
        ]);
        Faculty::create([
            'name' => 'Software Engineering',
            'abbr' => 'SE',
            'image_url' => 'https://example.com/images/se.jpg',
        ]);
        Faculty::create([
            'name' => 'Data Science',
            'abbr' => 'DS',
            'image_url' => 'https://example.com/images/ds.jpg',
        ]);
        Faculty::create([
            'name' => 'Cyber Security',
            'abbr' => 'CSY',
            'image_url' => 'https://example.com/images/csy.jpg',
        ]);
        Faculty::create([
            'name' => 'Artificial Intelligence',
            'abbr' => 'AI',
            'image_url' => 'https://example.com/images/ai.jpg',
        ]);
        Faculty::create([
            'name' => 'Information Systems',
            'abbr' => 'IS',
            'image_url' => 'https://example.com/images/is.jpg',
        ]);
        Faculty::create([
            'name' => 'Network Engineering',
            'abbr' => 'NE',
            'image_url' => 'https://example.com/images/ne.jpg',
        ]);
        Faculty::create([
            'name' => 'Multimedia Technology',
            'abbr' => 'MMT',
            'image_url' => 'https://example.com/images/mmt.jpg',
        ]);
        Faculty::create([
            'name' => 'Game Development',
            'abbr' => 'GD',
            'image_url' => 'https://example.com/images/gd.jpg',
        ]);
        Faculty::create([
            'name' => 'Robotics and Automation',
            'abbr' => 'RA',
            'image_url' => 'https://example.com/images/ra.jpg',
        ]);
    }
}
