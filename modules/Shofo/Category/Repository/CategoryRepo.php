<?php

namespace Shofo\Category\Repository;

use Shofo\Category\Models\Category;

class CategoryRepo
{
    public function all()
    {
        return Category::all();
    }

    public function allExeptById($id)
    {
        return $this->all()->filter(function ($item) use ($id) {
            return $item->id != $id;
        });
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

    public function edited($category, $request)
    {

        $dataArray = [
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->get('parent_id'),
        ];

        return $category->update($dataArray);
    }

    public function delete($category)
    {
        return $category->delete();
    }
}
