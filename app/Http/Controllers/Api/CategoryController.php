<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Search by name in current locale
        if ($request->has('search')) {
            $search = (string) $request->input('search', '');
            $locale = app()->getLocale();

            $query->where(function ($q) use ($search, $locale) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere("name_translations->{$locale}", 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere("description_translations->{$locale}", 'like', "%{$search}%");
            });
        }

        // Filter by parent category
        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->input('parent_id'));
        }

        // Get only active categories
        if ($request->boolean('active_only', true)) {
            $query->active();
        }

        $categories = $query->with('children')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate((int) $request->input('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully',
        ]);
    }

    /**
     * Display the specified category
     */
    public function show($id)
    {
        $category = Category::with(['children', 'parent'])->find($id);

        if (! $category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category retrieved successfully',
        ]);
    }

    /**
     * Get categories tree structure
     */
    public function tree()
    {
        $categories = Category::active()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories tree retrieved successfully',
        ]);
    }
}
