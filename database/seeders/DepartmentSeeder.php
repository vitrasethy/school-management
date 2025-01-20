<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // Departments for Faculty 1: Information Technology and Computer Science
        Department::create([
            'faculty_id' => 1,
            'name' => 'Software Development',
            'abbr' => 'SWD',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 1,
            'name' => 'Network Administration',
            'abbr' => 'NET',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 1,
            'name' => 'Database Management',
            'abbr' => 'DBM',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 2: Electrical and Electronic Engineering
        Department::create([
            'faculty_id' => 2,
            'name' => 'Power Systems',
            'abbr' => 'PWS',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 2,
            'name' => 'Electronic Circuits',
            'abbr' => 'ELC',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 2,
            'name' => 'Control Systems',
            'abbr' => 'CNS',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 3: Mechanical Engineering Technology
        Department::create([
            'faculty_id' => 3,
            'name' => 'Automotive Engineering',
            'abbr' => 'AUT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 3,
            'name' => 'Thermodynamics',
            'abbr' => 'THD',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 3,
            'name' => 'Manufacturing Processes',
            'abbr' => 'MFP',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 4: Artificial Intelligence and Data Science
        Department::create([
            'faculty_id' => 4,
            'name' => 'Machine Learning',
            'abbr' => 'MLN',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 4,
            'name' => 'Big Data Analytics',
            'abbr' => 'BDA',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 4,
            'name' => 'Computer Vision',
            'abbr' => 'CVN',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 5: Telecommunications and Networking
        Department::create([
            'faculty_id' => 5,
            'name' => 'Wireless Communications',
            'abbr' => 'WCM',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 5,
            'name' => 'Network Security',
            'abbr' => 'NSC',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 5,
            'name' => 'Digital Communications',
            'abbr' => 'DCM',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 6: Industrial and Manufacturing Technology
        Department::create([
            'faculty_id' => 6,
            'name' => 'Industrial Automation',
            'abbr' => 'IAT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 6,
            'name' => 'Quality Control',
            'abbr' => 'QCT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 6,
            'name' => 'Production Management',
            'abbr' => 'PMT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 7: Robotics and Automation Technology
        Department::create([
            'faculty_id' => 7,
            'name' => 'Robotic Systems',
            'abbr' => 'RBS',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 7,
            'name' => 'Mechatronics',
            'abbr' => 'MCT',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 7,
            'name' => 'Autonomous Systems',
            'abbr' => 'ATS',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 8: Digital Media and Design Technology
        Department::create([
            'faculty_id' => 8,
            'name' => 'Digital Animation',
            'abbr' => 'DAN',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 8,
            'name' => 'Interactive Media',
            'abbr' => 'IMD',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 8,
            'name' => 'Game Development',
            'abbr' => 'GMD',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 9: Cybersecurity and Information Assurance
        Department::create([
            'faculty_id' => 9,
            'name' => 'Network Security',
            'abbr' => 'NSE',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 9,
            'name' => 'Digital Forensics',
            'abbr' => 'DFR',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 9,
            'name' => 'Information Security',
            'abbr' => 'ISC',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);

        // Departments for Faculty 10: Software Engineering Technology
        Department::create([
            'faculty_id' => 10,
            'name' => 'Web Development',
            'abbr' => 'WEB',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 10,
            'name' => 'Mobile Applications',
            'abbr' => 'MAP',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Department::create([
            'faculty_id' => 10,
            'name' => 'Cloud Computing',
            'abbr' => 'CLC',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
    }
}
