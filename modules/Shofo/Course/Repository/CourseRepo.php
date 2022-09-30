<?php

namespace Shofo\Course\Repository;

use Shofo\Course\Models\Course;

class CourseRepo
{
    public function store($request)
    {
        $data = [
            'teacher_id' => $request->get('teacher_id'),
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'slug' => \Str::slug($request->get('slug')),
            'priority' => $request->get('priority'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'percent' => $request->get('percent'),
            'body' => $request->get('body'),
        ];

        return Course::query()->create($data);
    }

    public function all()
    {
        return Course::all();
    }
}
