<?php

namespace Shofo\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Shofo\Category\Http\Requests\CategoryRequest;
use Shofo\Category\Repository\CategoryRepo;

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
}
