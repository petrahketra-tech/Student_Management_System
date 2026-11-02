<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'students.manage',
            'courses.manage',
            'registrations.manage',
            'users.manage',
            'courses.view-assigned',
            'courses.view-available',
            'registrations.view-own',
            'registrations.create-own',
        ];

        foreach ($permissions as $name) {
            Permission::findOrCreate($name, 'web');
        }

        Role::findOrCreate('admin', 'web')->syncPermissions([
            'students.manage', 'courses.manage', 'registrations.manage', 'users.manage',
        ]);

        Role::findOrCreate('lecturer', 'web')->syncPermissions([
            'courses.view-assigned',
        ]);

        Role::findOrCreate('student', 'web')->syncPermissions([
            'courses.view-available', 'registrations.view-own', 'registrations.create-own',
        ]);
    }
}
