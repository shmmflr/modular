<?php

namespace Shofo\RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation.php rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'id' => ['required', 'exists:roles'],
            'name' => ['required', 'min:3', Rule::unique('roles')->ignore(request()->get('id'))],
            'permissions' => ['required' , 'array', 'min:1']
        ];
    }
}
