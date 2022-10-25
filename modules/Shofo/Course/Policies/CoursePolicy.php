<?php

namespace Shofo\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Shofo\RolePermission\Models\Permission;


class CoursePolicy
{

    use HandlesAuthorization;

    public
    function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    public
    function create($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    public
    function edit($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    function confirmStatus($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    public
    function destory($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    public
    function destails($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $user->id == $course->teacher_id
        ) {
            return true;
        }
    }
    public
    function createSection($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $user->id == $course->teacher_id
        ) {
            return true;
        }
    }
}
