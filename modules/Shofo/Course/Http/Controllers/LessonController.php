<?php

namespace Shofo\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Shofo\Course\Models\Course;
use Shofo\Course\Repository\CourseRepo;
use Shofo\Course\Repository\LessonRepo;
use Shofo\Course\Repository\SectionRepo;
use Shofo\Media\Services\MediaCoreService;

class LessonController extends Controller
{
    private $sectionRepo;
    private $lessonRepo;
    private $courseRepo;

    public function __construct(SectionRepo $sectionRepo, LessonRepo $lessonRepo, CourseRepo $courseRepo)
    {
        $this->sectionRepo = $sectionRepo;
        $this->lessonRepo = $lessonRepo;
        $this->courseRepo = $courseRepo;
    }


    public function create($courseId)
    {
        $course = $this->courseRepo->findById($courseId);
        $sections = $this->sectionRepo->sections($courseId);

        return view('Courses::Lesson.create', compact('sections', 'course'));
    }

    public function store(Course $course, Request $request)
    {
        $request->request
            ->add(['file_id' => MediaCoreService::upload($request->file('media'))->id]);
        $this->lessonRepo->store($course, $request);

        feedbacks();
        return back();
    }
}
