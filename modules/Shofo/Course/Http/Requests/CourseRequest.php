<?php

namespace Shofo\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shofo\Course\Models\Course;
use Shofo\Course\Rules\TeacherRule;

class CourseRequest extends FormRequest
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
            'slug' => ['required', 'string', 'min:3', 'unique:courses,slug'],
            'priority' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric', 'min:0'],
            'percent' => ['required', 'numeric', 'max:100', 'min:0'],
            'teacher_id' => ['required', 'exists:users,id', new TeacherRule()],
            'type' => ['required', Rule::in(Course::$types)],
            'status' => ['required', Rule::in(Course::$statuses)],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['required', 'mimes:png,jpeg,jpg'],
            'body' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'slug' => 'نام انگلیسی',
            'priority' => 'اولویت',
            'price' => 'قیمت',
            'percent' => 'در صد مدرس',
            'teacher_id' => 'مدرس',
            'type' => 'نوع',
            'status' => 'وضعیت',
            'category_id' => 'دسته بندی',
            'image' => 'تصویر',
            'body' => 'توضیحات',
        ];
    }
}
