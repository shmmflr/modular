<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Shofo\User\Helper\VerifyCodeHelper;
use Shofo\User\Rules\ValidaPassword;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'password' => ['required', new ValidaPassword(), 'confirmed']
        ];
    }
}
