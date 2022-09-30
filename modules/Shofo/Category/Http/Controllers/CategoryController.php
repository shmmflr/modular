<?php

namespace Shofo\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Shofo\Category\Http\Requests\CategoryRequest;
use Shofo\Category\Models\Category;
use Shofo\Category\Repository\CategoryRepo;
use Shofo\Common\Responses\AjaxResponses;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }


    public function index()
    {
        $categories = $this->categoryRepo->all();
        return view('Category::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->create($request);
        feedbacks();
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        $categories = $this->categoryRepo->allExeptById($category->id);
        return view('Category::update', compact('category', 'categories'));
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $this->categoryRepo->edited($category, $request);
        feedbacks();
        return back();
    }

    public function destroy(Category $category)
    {
        $this->categoryRepo->delete($category);
        feedbacks();
        return AjaxResponses::success();
    }
}
