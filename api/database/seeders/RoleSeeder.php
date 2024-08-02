<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_operador = Role::create(['name' => 'operador']);

        $role_admin->givePermissionTo([
            'home-view',
            'dashboard-view',
            'user-view',
            'user-create',
            'user-update',
            'user-delete',
            'training-view',
            'training-create',
            'training-update',
            'training-delete',
        ]);

        $role_operador->givePermissionTo([
            'home-view',
        ]);
    }
}
