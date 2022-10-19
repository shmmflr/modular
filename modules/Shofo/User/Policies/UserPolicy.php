<?php

namespace Shofo\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Shofo\RolePermission\Models\Permission;

class UserPolicy
{
    use HandlesAuthorization;

    public function show($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)
            ? true
            : null;
    }

    public function addRole($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)
            ? true
            : null;
    }

    public function removeRole($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)
            ? true
            : null;
    }

    public function updateProfile()
    {
        return auth()->check()
            ? true
            : null;
    }
}
