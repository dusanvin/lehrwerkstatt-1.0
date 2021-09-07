<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $permissions = [

           'view-stats',

           'view-persons'

           //view_roles_edit_roles,add_roles,delete_roles

        ];

     

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }
    }
}
