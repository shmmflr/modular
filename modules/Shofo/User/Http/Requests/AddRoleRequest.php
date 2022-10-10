<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user() == true;
    }

    /**
     * Get the validation.php rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role' => ['required', 'exists:roles,name']
        ];
    }
}
