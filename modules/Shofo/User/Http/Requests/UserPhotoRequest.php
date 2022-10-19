<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPhotoRequest extends FormRequest
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
            'photo' => ['required', 'mimes:jpeg,jpg,png']
        ];
    }
}
