<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->with(['parent', 'children'])
            ->withCount([
                'tasks as tasks_count' => function ($q) {
                    $q->where('status', 'open');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(36);

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::active()->findOrFail($id);

        $tasks = Task::with(['client', 'category'])
            ->where('category_id', $id)
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $subcategories = Category::active()
            ->where('parent_id', $id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('categories.show', compact('category', 'tasks', 'subcategories'));
    }
}
