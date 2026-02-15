<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            'product.manage',
            'order.manage',
            'role.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $vendor     = Role::firstOrCreate(['name' => 'vendor']);
        $customer   = Role::firstOrCreate(['name' => 'customer']);

        // Assign permissions
        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'user.view',
            'product.manage',
            'order.manage',
        ]);
    }
}