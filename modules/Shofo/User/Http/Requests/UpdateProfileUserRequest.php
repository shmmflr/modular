<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shofo\RolePermission\Models\Permission;
use Shofo\User\Models\User;
use Shofo\User\Rules\ValidaPassword;

class UpdateProfileUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user() == true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'mobile' => ['required', Rule::unique('users', 'mobile')->ignore(auth()->id())],
            'username' => ['required', Rule::unique('users', 'username')->ignore(auth()->id())],
            'password' => ['nullable', new ValidaPassword()]
        ];

        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH)) {
            $rules += [
                'shaba' => ['required', 'string', 'size::24'],
                'card_number' => ['required', 'string', 'size::16'],
                'bio' => ['required', 'string', 'min:10', 'max:60'],
            ];
        }


        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'نام نام خانوادگی',
            'email' => 'ایمیل',
            'mobile' => 'موبایل',
            'shaba' => 'شماره عابر یانک',
            'card_number' => 'شماره شبا',
            'bio' => 'بیو',
        ];
    }
}
