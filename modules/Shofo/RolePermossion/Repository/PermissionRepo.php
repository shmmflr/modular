<?php

namespace Shofo\RolePermission\Repository;

use Spatie\Permission\Models\Permission;

class PermissionRepo
{

    public function all()
    {
        return Permission::all();
    }

}
