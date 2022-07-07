<?php

namespace Shofo\RolePermission\Repository;

use Spatie\Permission\Models\Role;

class RoleRepo
{

    public function all()
    {
        return Role::all();
    }

    public function create($request)
    {
        return Role::create(['name' => $request->name])->syncPermissions($request->permission);
    }

    public function update($roleId, $request)
    {
        return Role::findById($roleId)
            ->syncPermissions($request->get('permissions'))
            ->update($request->get('name'));
    }

    public function delete($id)
    {
        return Role::findById($id)->delete();
    }

}
