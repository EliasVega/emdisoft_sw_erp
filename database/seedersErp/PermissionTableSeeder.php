<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'show-rol',
            'create-rol',
            'edit-rol',
            'delete-rol',

            'show-branch',
            'create-branch',
            'edit-branch',
            'delete-branch',

            'show-company',
            'create-company',
            'edit-company',
            'delete-company',
        ];
        foreach ($permissions as $key => $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
