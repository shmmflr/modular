<?php

namespace Shofo\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shofo\Course\Models\Course;
use Shofo\Course\Rules\TeacherRule;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation.php rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3'],
            'number' => ['nullable', 'min:0'],
        ];

    }

    public function attributes()
    {
        return [
            'title' => ' عنوان دوره',
            'number' => 'ردیف دوره',

        ];
    }
}
