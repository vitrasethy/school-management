<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'read activities'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'read a activity'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'write a activity'])
            ->assignRole(['school admin', 'department admin', 'teacher']);

        Permission::create(['name' => 'read activity types'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'read a activity type'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'write activity type'])
            ->assignRole('school admin');

        Permission::create(['name' => 'write a school']);

        Permission::create(['name' => 'read schools']);

        Permission::create(['name' => 'read a school'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'read a department'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'read departments'])
            ->assignRole(['school admin', 'department admin']);

        Permission::create(['name' => 'write department'])
            ->assignRole('school admin');

        Permission::create(['name' => 'write group'])
            ->assignRole(['school admin', 'department admin']);

        Permission::create(['name' => 'read a group'])
            ->assignRole(['school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'read groups'])
            ->assignRole(['school admin', 'department admin', 'teacher']);
    }
}
