<?php

namespace Shofo\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Shofo\Category\Repository\CategoryRepo;
use Shofo\Common\Responses\AjaxResponses;
use Shofo\Course\Http\Requests\CourseRequest;
use Shofo\Course\Models\Course;
use Shofo\Course\Repository\CourseRepo;
use Shofo\Media\Services\MediaCoreService;
use Shofo\User\Repository\UserRepo;

class CourseController extends Controller
{
    private CourseRepo $courseRepo;
    private CategoryRepo $categoryRepo;
    private UserRepo $userRepo;

    public function __construct(CourseRepo $courseRepo, CategoryRepo $categoryRepo, UserRepo $userRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $this->authorize('index', Course::class);
        $courses = $this->courseRepo->paginate();
        return view('Courses::index', compact('courses'));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        $categories = $this->categoryRepo->all();
        $teachers = $this->userRepo->teachers();
        return view('Courses::create', compact('categories', 'teachers'));
    }

    public function store(CourseRequest $request,)
    {
        $this->authorize('create', Course::class);
        $request->request
            ->add(['banner_id' => MediaCoreService::upload($request->file('image'))->id]);

        $this->courseRepo->store($request);

        return redirect()->route('course.index');
    }

    public function edit($id)
    {
        $this->authorize('edit', Course::class);
        $course = $this->courseRepo->findById($id);
        $categories = $this->categoryRepo->all();
        $teachers = $this->userRepo->teachers();

        return view('Courses::edit',
            compact('course', 'categories', 'teachers'));
    }

    public function update($id, CourseRequest $request)
    {
        $this->authorize('edit', Course::class);

        $course = $this->courseRepo->findById($id);

        if ($request->hasFile('image')) {
            $request->request
                ->add(['banner_id' => MediaCoreService::upload($request->file('image'))->id]);
            $course->banner->delete();
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        $this->courseRepo->update($course, $request);

        feedbacks();
        return redirect()->route('course.edit', $id);
    }

    public function accept($id)
    {
        $this->authorize('confirmStatus', Course::class);
        if ($this->courseRepo->confirmCourseStatus($id, Course::CONFIRMATION_ACCEPT)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject($id)
    {
        $this->authorize('confirmStatus', Course::class);

        if ($this->courseRepo->confirmCourseStatus($id, Course::CONFIRMATION_REJECT)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function details(Course $course)
    {
        $this->authorize('destails', $course);

        return view('Courses::detail', compact('course'));
    }

    public function destroy($id)
    {
        $this->authorize('destroy', Course::class);

        $this->courseRepo->delete($id);
    }
}
