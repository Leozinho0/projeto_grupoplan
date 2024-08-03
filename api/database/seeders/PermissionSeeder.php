<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $models = [
            [ 
                'home-view',
            ],
            [ 
                'dashboard-view',
            ],
            [
                'user-view',
                'user-create',
                'user-update',
                'user-delete',
            ],
            [
                'training-view',
                'training-create',
                'training-update',
                'training-delete',
            ],
        ];

        foreach($models as $model) {
            foreach($model as $permission){
                Permission::create(['name' => $permission]);
            }
        }
    }
}
