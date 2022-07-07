<?php

namespace Shofo\Category\Repository;

use Shofo\Category\Models\Category;

class CategoryRepo
{
    public function all()
    {
        return Category::all();
    }

    public function create($request)
    {
        $dataArray = [
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->get('parent_id'),
        ];

        return Category::query()->create($dataArray);
    }
}
