<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create([
            'name'          => 'superadmin',
            'guard_name'    => 'web',
        ]);
        $superadmin->givePermissionTo([
            'user delete',
            'user update',
            'user read',
            'user create',
            'role delete',
            'role update',
            'role read',
            'role create',
            'permission delete',
            'permission update',
            'permission read',
            'permission create',
            'setting read',
            'activity read',
            'activity delete',
        ]);
        $admin = Role::create([
            'name'          => 'admin',
            'guard_name'    => 'web',
        ]);
        $admin->givePermissionTo([
            'user delete',
            'user update',
            'user read',
            'user create',
            'role read',
            'permission read',
        ]);
        $operator = Role::create([
            'name'          => 'operator',
            'guard_name'    => 'web',
        ]);
        
        $operator->givePermissionTo([
            'user read',
            'role read',
            'permission read',
        ]);
    }
}
