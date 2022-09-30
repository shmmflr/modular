<?php

namespace Shofo\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Shofo\Category\Repository\CategoryRepo;
use Shofo\Course\Http\Requests\CourseRequest;
use Shofo\Course\Repository\CourseRepo;
use Shofo\User\Repository\UserRepo;

class CourseController extends Controller
{
    public function index(CourseRepo $courseRepo)
    {

        $courses = $courseRepo->all();
        return $courses;
    }

    public function create(CategoryRepo $categoryRepo, UserRepo $userRepo)
    {
        $categories = $categoryRepo->all();
        $teachers = $userRepo->teachers();
        return view('Courses::create', compact('categories', 'teachers'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->store($request);

        return $course;
    }
}
