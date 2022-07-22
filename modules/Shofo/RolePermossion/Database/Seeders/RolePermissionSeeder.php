<?php

namespace Shofo\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Shofo\RolePermission\Models\Permission;
use Shofo\RolePermission\Models\Role;


class RolePermissionSeeder extends Seeder
{

    public function run()
    {
        // Permissions
        foreach (Permission::$permissions as $permission) {
            \Spatie\Permission\Models\Permission::findOrCreate($permission);
        }

        //Roles
        foreach (Role::$roles as $name => $permission) {
            \Spatie\Permission\Models\Role::findOrCreate($name)->givePermissionTo($permission);
        }

    }

}

