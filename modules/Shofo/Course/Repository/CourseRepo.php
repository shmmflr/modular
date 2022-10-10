<?php

namespace Shofo\Course\Repository;

use Shofo\Common\Responses\AjaxResponses;
use Shofo\Course\Models\Course;

class CourseRepo
{
    public function store($request)
    {
        $data = [
            'teacher_id' => $request->get('teacher_id'),
            'category_id' => $request->get('category_id'),
            'banner_id' => $request->get('banner_id'),
            'title' => $request->get('title'),
            'slug' => \Str::slug($request->get('slug')),
            'priority' => $request->get('priority'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'percent' => $request->get('percent'),
            'body' => $request->get('body'),
        ];

        return Course::query()->create($data);
    }

    public function paginate()
    {
        return Course::query()->paginate();
    }

    public function findById($id)
    {
        return Course::query()->findOrFail($id);
    }

    public function delete($id)
    {

        $course = $this->findById($id);
        if ($course->banner) {
            $course->banner->delete();
        }

        $course->delete();

        return AjaxResponses::success();
    }

    public function update($course, $request)
    {
        $data = [
            'teacher_id' => $request->get('teacher_id'),
            'category_id' => $request->get('category_id'),
            'banner_id' => $request->get('banner_id'),
            'title' => $request->get('title'),
            'slug' => \Str::slug($request->get('slug')),
            'priority' => $request->get('priority'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'percent' => $request->get('percent'),
            'body' => $request->get('body'),
        ];

        return $course->update($data);
    }


    public function confirmCourseStatus($id, $status)
    {
        return Course::query()->find($id)->update(['confirmation' => $status]);
    }
}
