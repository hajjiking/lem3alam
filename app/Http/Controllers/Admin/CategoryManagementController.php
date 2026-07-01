<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only(['name', 'description']));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $mergeTargets = Category::query()
            ->whereKeyNot($category->id)
            ->orderBy('name')
            ->get(['id', 'name', 'parent_id']);

        return view('admin.categories.show', compact('category', 'mergeTargets'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function merge(Request $request, Category $category)
    {
        $validated = $request->validate([
            'target_id' => 'required|integer|exists:categories,id',
        ]);

        $targetId = (int) $validated['target_id'];
        if ($targetId === (int) $category->id) {
            return back()->with('error', 'Target category must be different.');
        }

        $target = Category::findOrFail($targetId);
        if ((int) $category->parent_id !== (int) $target->parent_id) {
            return back()->with('error', 'Both categories must have the same parent to merge safely.');
        }

        DB::transaction(function () use ($category, $target) {
            DB::table('tasks')->where('category_id', $category->id)->update(['category_id' => $target->id]);
            DB::table('skills')->where('category_id', $category->id)->update(['category_id' => $target->id]);
            DB::table('portfolio_items')->where('category_id', $category->id)->update(['category_id' => $target->id]);

            DB::table('categories')
                ->where('parent_id', $category->id)
                ->where('id', '!=', $target->id)
                ->update(['parent_id' => $target->id]);

            $category->delete();
        });

        return redirect()
            ->route('admin.categories.show', $target)
            ->with('success', 'Category merged successfully.');
    }
}
