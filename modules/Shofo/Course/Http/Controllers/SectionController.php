<?php

namespace Shofo\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Shofo\Common\Responses\AjaxResponses;
use Shofo\Course\Http\Requests\SectionRequest;
use Shofo\Course\Models\Course;
use Shofo\Course\Models\Section;
use Shofo\Course\Repository\SectionRepo;

class SectionController extends Controller
{
    public SectionRepo $sectionRepo;

    public function __construct(SectionRepo $sectionRepo)
    {
        $this->sectionRepo = $sectionRepo;
    }

    public function store(Course $course, SectionRequest $request)
    {
        $this->authorize('createSection', $course);
        $this->sectionRepo->store($course, $request);

        feedbacks();

        return redirect()->back();
    }

    public function edit(Section $section)
    {
        $this->authorize('edit', $section);
        return view('Courses::Section.edit', compact('section'));
    }

    public function update(Section $section, SectionRequest $request)
    {
        $this->authorize('edit', $section);
        $this->sectionRepo->update($section, $request);
        feedbacks();
        return redirect()->back();
    }

    public function accept($id)
    {
        $this->authorize('confirmStatus', Section::class);
        if ($this->sectionRepo->sectionStatus($id, Section::CONFIRMATION_ACCEPT)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject($id)
    {
        $this->authorize('confirmStatus', Section::class);

        if ($this->sectionRepo->sectionStatus($id, Section::CONFIRMATION_REJECT)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function destroy($id)
    {
        $section = $this->sectionRepo->findById($id);
        $this->authorize('destroy', $section);

        $this->sectionRepo->delete($id);
    }

}
