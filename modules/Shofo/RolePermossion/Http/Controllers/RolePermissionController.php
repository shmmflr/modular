<?php

namespace Shofo\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    public function index()
    {
        return view('Role::index');
    }
}
