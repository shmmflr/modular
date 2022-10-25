<?php

namespace Shofo\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shofo\Course\Models\Course;
use Shofo\Course\Rules\SectionRule;
use Shofo\Course\Rules\TeacherRule;

class LessonRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:3'],
            'slug' => ['nullable', 'string', 'min:3'],
            'time' => ['numeric', 'min:0', 'max:255'],
            'priority' => ['numeric', 'min:0'],
            'session_id' => [new SectionRule()],
            'free' => ['boolean', 'required'],
            'media' => ['nullable', 'file', 'mimes:mp4,mkv,avi,zip,rar'],
            'body' => ['nullable', 'string', 'max:1000'],
        ];
//        if (request()->method === 'PATCH') {
//            $rules['slug'] = ['required', 'string', 'min:3', Rule::unique('courses')->ignore(request()->route('course'))];
//            $rules['image'] = ['nullable', 'mimes:png,jpeg,jpg'];
//        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان درس',
            'slug' => 'نام انگلیسی درس',
            'time' => 'زمان درس',
            'priority' => 'اولویت نمایش',
            'section_id' => 'سر فصل درس',
            'free' => "قیمت درس",
            'media' => 'فایل',
            'body' => 'توضیحات درس',
        ];
    }
}
