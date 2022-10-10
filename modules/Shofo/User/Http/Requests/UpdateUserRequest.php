<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shofo\User\Models\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user() == true;
    }

    public function rules()
    {
        $user = $this->route('user');
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'mobile' => ['required', Rule::unique('users', 'mobile')->ignore($user->id)],
            'status' => ['required', Rule::in(User::$statuses)],
            'image_id' => ['nullable', 'mimes:jpeg,jpg,png']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'نام نام خانوادگی',
            'email' => 'ایمیل',
            'mobile' => 'موبایل',
            'status' => 'وضعیت',
            'image_id' => 'عکس پروفایل'
        ];
    }
}
