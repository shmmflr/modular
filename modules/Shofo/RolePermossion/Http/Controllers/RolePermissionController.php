<?php

namespace Shofo\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Shofo\RolePermission\Http\Requests\RolePermissionRequest;
use Shofo\RolePermission\Http\Requests\RoleUpdatePermissionRequest;
use Shofo\RolePermission\Repository\PermissionRepo;
use Shofo\RolePermission\Repository\RoleRepo;
use Spatie\Permission\Models\Role;

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
//        $this->authorize('index', Role::class);
        $roles = $this->roleRepo->all();
        $permissions = $this->permissionRepo->all();
        return view('RolePermission::index', compact('roles', 'permissions'));
    }

    public function store(RolePermissionRequest $request)
    {
//        $this->authorize('create', Role::class);

        $this->roleRepo->create($request);
        feedbacks();
        return redirect()->route('role_permissions.index');

    }

    public function edit($id)
    {
//        $this->authorize('edit', Role::class);
        $role = $this->roleRepo->findById($id);
        $permissions = $this->permissionRepo->all();
        return view('RolePermission::update', compact('role', 'permissions'));
    }

    public function update(RoleUpdatePermissionRequest $request, $id)
    {
//        $this->authorize('edit', Role::class);
        $this->roleRepo->update($id, $request);
        feedbacks();
        return back();
    }

    public function destroy($id)
    {
//        $this->authorize('destroy', Role::class);
        $this->roleRepo->delete($id);
        return response()->json(['msg' => 'حذف با موفقیت انجام شد']);
    }
}
