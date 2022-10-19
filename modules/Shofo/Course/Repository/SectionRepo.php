<?php

namespace Shofo\Course\Repository;

use Shofo\Common\Responses\AjaxResponses;
use Shofo\Course\Models\Course;
use Shofo\Course\Models\Section;

class SectionRepo
{
    public function store($course, $request)
    {

        $data = [
            'title' => $request->get('title'),
            'number' => $this->generateNumber($request, $course->id),
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ];

        return Section::query()->create($data);
    }

    public function paginate()
    {
        return Section::query()->paginate();
    }

    public function findById($id)
    {
        return Section::query()->findOrFail($id);
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

    public function update($section, $request)
    {
        $data = [
            'title' => $request->get('title'),
            'number' => $this->generateNumber($request, $section->course_id),
        ];

        return $section->update($data);
    }


    public function sectionStatus($id, $status)
    {
        return Section::query()->find($id)->update(['status' => $status]);
    }


    public function generateNumber($request, $course_id): mixed
    {
        $course = new CourseRepo();
        if (is_null($request->get('number'))) {
            $number = $course->findById($course_id)->sections()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        } else {
            $number = $request->get('number');
        }
        return $number;
    }
}
