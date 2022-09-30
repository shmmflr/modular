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
        return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
    }

    public function findById($id)
    {
        return Role::query()->find($id);
    }

    public function update($roleId, $request)
    {
        return $this->findById($roleId)
            ->syncPermissions($request->permissions)
            ->update(['name' => $request->name]);
    }


    public function delete($id)
    {
        return Role::findById($id)->delete();
    }

}
