<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'read activities'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'read a activity'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'write a activity'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher']);

        Permission::create(['name' => 'read activity types'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'read a activity type'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'write activity type'])
            ->assignRole('School Admin');

        Permission::create(['name' => 'write a school']);

        Permission::create(['name' => 'read schools']);

        Permission::create(['name' => 'read a school'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'read a department'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'read departments'])
            ->assignRole(['School Admin', 'Department Admin']);

        Permission::create(['name' => 'write department'])
            ->assignRole('School Admin');

        Permission::create(['name' => 'write group'])
            ->assignRole(['School Admin', 'Department Admin']);

        Permission::create(['name' => 'read a group'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher', 'Student']);

        Permission::create(['name' => 'read groups'])
            ->assignRole(['School Admin', 'Department Admin', 'Teacher']);
    }
}
