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
// TODO IMPORT https://sweetalert2.github.io/ IN PROJECT

        $this->categoryRepo->create($request);
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
        return back();
    }

    public function destroy(Category $category)
    {
        $this->categoryRepo->delete($category);
        return AjaxResponses::success();
    }
}
