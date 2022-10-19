<?php

namespace Shofo\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Shofo\Common\Responses\AjaxResponses;
use Shofo\Media\Services\MediaCoreService;
use Shofo\RolePermission\Models\Role;
use Shofo\RolePermission\Repository\RoleRepo;
use Shofo\User\Http\Requests\AddRoleRequest;
use Shofo\User\Http\Requests\UpdateProfileUserRequest;
use Shofo\User\Http\Requests\UpdateUserRequest;
use Shofo\User\Http\Requests\UserPhotoRequest;
use Shofo\User\Models\User;
use Shofo\User\Repository\UserRepo;

class UserController extends Controller
{

    protected UserRepo $userRepo;
    public RoleRepo $roleRepo;

    public function __construct(UserRepo $userRepo, RoleRepo $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $this->authorize('show', User::class);
        $users = User::all();
        $roles = Role::all();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function addRoles(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);

        $user->assignRole($request->get('role'));
        feedbacks();
        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);

        $user = $this->userRepo->findById($userId);
        $user->removeRole($role);
        return AjaxResponses::success();
    }

    public function edit(User $user)
    {
        $roles = $this->roleRepo->all();
        return view('User::Admin.edit', compact('user', 'roles'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {


        if ($request->hasFile('image')) {
            $request->request
                ->add(['image_id' => MediaCoreService::upload($request->file('image'))->id]);
            if ($user->image_id != null) $user->image_id->delete();
        } else {
            $request->request->add(['image_id' => $user->image_id]);
        }
        $this->userRepo->update($user, $request);

        feedbacks();
        return redirect()->back();
    }

    public function viewProfile()
    {

    }

    public function editProfile()
    {
        $this->authorize('updateProfile', User::class);
        return view('User::Admin.profile');
    }

    public function updateProfile(UpdateProfileUserRequest $request)
    {
        $this->authorize('updateProfile', User::class);
        $this->userRepo->updateProfile($request);

        feedbacks();
        return back();
    }


    public function verifyEmail(User $user)
    {
        $user->markEmailAsVerified();

        return AjaxResponses::success();
    }

    public function uploadPhoto(UserPhotoRequest $request)
    {

        $photo = MediaCoreService::upload($request->file('photo'));

        if (auth()->user()->image) {
            auth()->user()->image->delete();
        }
        auth()->user()->image_id = $photo->id;
        auth()->user()->save();
        feedbacks();
        return back();
    }


    public function destroy(User $user)
    {

        $this->userRepo->deleteUser($user);
        feedbacks();
        return AjaxResponses::success();
    }
}
