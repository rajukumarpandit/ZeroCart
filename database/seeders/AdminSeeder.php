<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin Role (if not exists)
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@zyrocart.com'],
            [
                'name'       => 'Super Admin',
                'username'   => 'superadmin',
                'phone'      => '9999999999',
                'password'   => Hash::make('Admin@123'),
                'is_active'  => true,
                'type'       => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        // Assign Role
        if (! $admin->hasRole($role->name)) {
            $admin->assignRole($role);
        }
    }
}