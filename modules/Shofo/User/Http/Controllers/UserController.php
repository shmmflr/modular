<?php

namespace Shofo\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Shofo\Common\Responses\AjaxResponses;
use Shofo\RolePermission\Models\Role;
use Shofo\User\Models\User;
use Shofo\User\Repository\UserRepo;

class UserController extends Controller
{

    protected UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
//        $this->authorize('show', User::class);
        $users = User::all();
        $roles = Role::all();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function addRoles(Request $request, User $user)
    {
//        $this->authorize('addRole', User::class);
        $user->assignRole($request->get('role'));
        feedbacks();
        return back();
    }

    public function removeRole($userId, $role)
    {
        dd(123);
    }

    public function destroy(User $user)
    {

        $this->userRepo->deleteUser($user);
        feedbacks();
        return AjaxResponses::success();
    }
}
