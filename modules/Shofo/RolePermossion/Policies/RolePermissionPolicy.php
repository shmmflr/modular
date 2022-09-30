<?php

namespace Shofo\RolePermission\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Shofo\RolePermission\Models\Permission;


class RolePermissionPolicy
{

    use HandlesAuthorization;

    public
    function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)
            ? true
            : null;
    }

    public
    function create($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)
            ? true
            : null;
    }

    public
    function edit($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)
            ? true
            : null;
    }

    public
    function destory($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)
            ? true
            : null;
    }
}
