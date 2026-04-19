<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $kasirRole = Role::firstOrCreate(['name' => 'kasir', 'guard_name' => 'web']);

        $permissions = [
            'manage users',
            'manage employees',
            'manage products',
            'manage stock in',
            'manage stock out',
            'manage finance',
            'view reports',
            'view audit logs',
            'create transaction',
            'view transaction',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole->givePermissionTo($permissions);
        $kasirRole->givePermissionTo(['create transaction', 'view transaction']);
    }
}