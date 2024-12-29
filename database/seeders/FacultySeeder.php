<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        Faculty::create([
            'name' => 'Humanities Division',
            'abbr' => 'HUM',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Faculty::create([
            'name' => 'Mathematical, Physical and Life Sciences Division',
            'abbr' => 'MPLS',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Faculty::create([
            'name' => 'Medical Sciences Division',
            'abbr' => 'MSD',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Faculty::create([
            'name' => 'Social Sciences Division',
            'abbr' => 'SOC',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
        Faculty::create([
            'name' => 'Gardens, Libraries and Museums',
            'abbr' => 'GLM',
            'image_url' => 'https://i.pinimg.com/736x/99/79/47/99794745d5b0d82459e1fcf810685bc7.jpg',
        ]);
    }
}
