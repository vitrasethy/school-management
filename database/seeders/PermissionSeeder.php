<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create school']);

        Permission::create(['name' => 'view all schools'])
            ->assignRole('super admin');

        Permission::create(['name' => 'view own school'])
            ->assignRole(['super admin', 'school admin', 'department admin', 'teacher', 'student']);

        Permission::create(['name' => 'edit all schools'])
            ->assignRole(['super admin']);

        Permission::create(['name' => 'edit own school'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'delete own school'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'delete all school'])
            ->assignRole(['super admin']);

        Permission::create(['name' => 'create department'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'view all departments'])
            ->assignRole(['super admin']);

        Permission::create(['name' => 'view all departments within a school'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'view own department'])
            ->assignRole(['super admin', 'school admin', 'department admin']);

        Permission::create(['name' => 'edit all department'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'edit own departments'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'delete department'])
            ->assignRole(['super admin', 'school admin']);

        Permission::create(['name' => 'view all groups'])
            ->assignRole(['super admin']);

        Permission::create(['name' => 'view all group by own department'])
            ->assignRole(['super admin', 'school admin', 'department admin']);

        Permission::create(['name' => 'create group'])
            ->assignRole(['super admin', 'school admin', 'department admin']);

        Permission::create(['name' => 'view own group'])
            ->assignRole(['super admin', 'school admin', 'department admin', 'teacher', 'student']);
    }
}
