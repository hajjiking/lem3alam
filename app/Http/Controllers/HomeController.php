<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Get popular categories (limit to 8)
        $categories = Category::query()
            ->active()
            ->orderBy('id')
            ->take(8)
            ->get();

        $minorIndex = $categories->search(fn (Category $c) => $c->name === 'Minor Home Repairs');
        if ($minorIndex !== false) {
            $cleaning = Category::query()
                ->active()
                ->where('name', 'Cleaning & Housekeeping')
                ->whereNull('parent_id')
                ->first();

            if ($cleaning) {
                $categories[$minorIndex] = $cleaning;
            }
        }

        // Get featured/latest tasks (limit to 6)
        $featured_tasks = Task::with(['client', 'category'])
            ->where('status', 'open')
            ->latest()
            ->take(6)
            ->get();

        // Get platform statistics
        $stats = [
            'total_users' => User::count(),
            'total_tasks' => Task::count(),
            'completed_tasks' => Task::where('status', 'completed')->count(),
        ];

        return view('home', compact('categories', 'featured_tasks', 'stats'));
    }
}
