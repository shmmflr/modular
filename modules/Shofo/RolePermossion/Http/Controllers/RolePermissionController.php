<?php

namespace Shofo\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Shofo\RolePermission\Http\Requests\RolePermissionRequest;
use Shofo\RolePermission\Http\Requests\RoleUpdatePermissionRequest;
use Shofo\RolePermission\Repository\PermissionRepo;
use Shofo\RolePermission\Repository\RoleRepo;

class RolePermissionController extends Controller
{
    protected $roleRepo;
    protected $permissionRepo;

    public function __construct(RoleRepo $roleRepo, PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $roles = $this->roleRepo->all();
        $permissions = $this->permissionRepo;
        return view('RolePermission::index', compact('roles', 'permissions'));
    }

    public function store(RolePermissionRequest $request)
    {
        $this->roleRepo->create($request);
        $request->flash('msg', 'نقش کاربری با موفقیت ثبت شد');
        return redirect()->route('role-permission.index');

    }

    public function update(RoleUpdatePermissionRequest $request, $id)
    {
        $this->roleRepo->update($id, $request);
    }

    public function destroy($id)
    {
        $this->roleRepo->delete($id);
        return response()->json(['msg' => 'حذف با موفقیت انجام شد']);
    }
}
