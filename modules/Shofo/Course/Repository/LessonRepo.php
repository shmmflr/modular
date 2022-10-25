<?php

namespace Shofo\Course\Repository;

use Shofo\Common\Responses\AjaxResponses;
use Shofo\Course\Models\Lesson;


class LessonRepo
{
    public function store($course, $request)
    {
        $data = [
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'time' => $request->get('time'),
            'status' => Lesson::CONFIRMATION_ACCEPT,
            'free' => $request->get('type'),
            'priority' => $this->generateNumber($request, $course->id),
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'section_id' => $request->get('section_id'),
            'media_id' => $request->get('file_id'),//todo upload fails
            'body' => $request->get('body'),

        ];


        return Lesson::query()->create($data);
    }


    public function findById($id)
    {
        return Lesson::query()->findOrFail($id);
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
        return Lesson::query()->find($id)->update(['status' => $status]);
    }


    public function generateNumber($request, $course_id): mixed
    {
        $course = new CourseRepo();
        if (is_null($request->get('priority'))) {
            $number = $course->findById($course_id)->lessons()->orderBy('priority', 'desc')->firstOrNew([])->priority ?: 0;
            $number++;
        } else {
            $number = $request->get('priority');
        }
        return $number;
    }
}
