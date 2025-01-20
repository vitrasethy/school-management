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
            'name' => 'Electrical and Electronic Engineering',
            'abbr' => 'EEE',
            'image_url' => 'https://example.com/images/eee.jpg',

        ]);

        Faculty::create([
            'name' => 'Mechanical Engineering Technology',
            'abbr' => 'MET',
            'image_url' => 'https://example.com/images/met.jpg',

        ]);

        Faculty::create([
            'name' => 'Artificial Intelligence and Data Science',
            'abbr' => 'AIDS',
            'image_url' => 'https://example.com/images/aids.jpg',

        ]);

        Faculty::create([
            'name' => 'Telecommunications and Networking',
            'abbr' => 'TEL',
            'image_url' => 'https://example.com/images/tel.jpg',

        ]);

        Faculty::create([
            'name' => 'Industrial and Manufacturing Technology',
            'abbr' => 'IMT',
            'image_url' => 'https://example.com/images/imt.jpg',

        ]);

        Faculty::create([
            'name' => 'Robotics and Automation Technology',
            'abbr' => 'RAT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',

        ]);

        Faculty::create([
            'name' => 'Digital Media and Design Technology',
            'abbr' => 'DMD',
            'image_url' => 'https://example.com/images/dmd.jpg',

        ]);

        Faculty::create([
            'name' => 'Cybersecurity and Information Assurance',
            'abbr' => 'CIA',
            'image_url' => 'https://example.com/images/cia.jpg',

        ]);

        Faculty::create([
            'name' => 'Software Engineering Technology',
            'abbr' => 'SET',
            'image_url' => 'https://example.com/images/set.jpg',

        ]);
    }
}
