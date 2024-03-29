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

    public function findByIdAndCourse($id, $curse_id)
    {
        return Section::query()
            ->where('id', $id)
            ->where('course_id', $curse_id)
            ->first();
    }

    public function sections($course)
    {

        return Section::query()->where('course_id', $course)
            ->where('status', Section::CONFIRMATION_ACCEPT)
            ->orderBy('number')
            ->get();
    }

    public function findById($id)
    {
        return Section::query()->findOrFail($id);
    }

    public function delete($id)
    {

        $section = $this->findById($id);
        if ($section->banner) {
            $section->banner->delete();
        }

        $section->delete();

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
