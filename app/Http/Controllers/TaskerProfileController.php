<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PortfolioItem;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * TaskerProfileController
 *
 * Handles tasker profile management including profile editing, portfolio management,
 * and profile display functionality.
 */
class TaskerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('locale.auth')->except(['show']);
    }

    // Show tasker profile
    public function show($locale, $id)
    {
        $tasker = User::with(['activePortfolioItems.category', 'verifiedSkills'])
            ->whereKey($id)
            ->first();

        if (! $tasker) {
            return view('tasker.profile.not-found');
        }

        $portfolioItems = $tasker->activePortfolioItems()->paginate(12);
        $skills = $tasker->verifiedSkills;
        $reviews = \App\Models\Review::approved()
            ->where(function ($q) use ($tasker) {
                $q->where('tasker_id', $tasker->id)
                    ->orWhere('reviewee_id', $tasker->id);
            })
            ->with('client', 'task')
            ->latest()
            ->limit(3)
            ->get();

        return view('tasker.profile.show', compact('tasker', 'portfolioItems', 'skills', 'reviews'));
    }

    // Show edit profile form
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isTasker()) {
            abort(403, 'Access denied. Only taskers can edit profiles.');
        }

        $categories = Category::active()->get();
        $allSkills = Skill::active()->with('category')->get()->groupBy('category.name');
        $userSkills = $user->skills()->pluck('skills.id')->toArray();
        $skillPivot = $user->skills()->get()->keyBy('id');

        return view('tasker.profile.edit', compact('user', 'categories', 'allSkills', 'userSkills', 'skillPivot'));
    }

    // Update profile
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isTasker()) {
            abort(403, 'Access denied. Only taskers can update profiles.');
        }

        $request->validate([
            'bio' => 'nullable|string|max:1000',
            'bio_ar' => 'nullable|string|max:1000',
            'hourly_rate' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'skill_experience.*' => 'nullable|in:beginner,intermediate,advanced,expert',
            'skill_years.*' => 'nullable|integer|min:0|max:50',
            'skill_description.*' => 'nullable|string|max:500',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }

            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Update basic profile info
        $user->update([
            'bio' => $request->bio,
            'bio_translations' => [
                'fr' => $request->bio,
                'ar' => $request->bio_ar,
            ],
            'hourly_rate' => $request->hourly_rate,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
        ]);

        // Update skills
        if ($request->has('skills')) {
            $skillsData = [];
            foreach ($request->skills as $index => $skillId) {
                $skillsData[$skillId] = [
                    'experience_level' => $request->input("skill_experience.{$index}", 'beginner'),
                    'years_experience' => $request->input("skill_years.{$index}", 0),
                    'description' => $request->input("skill_description.{$index}"),
                    'is_verified' => false,
                ];
            }
            $user->skills()->sync($skillsData);
        } else {
            $user->skills()->detach();
        }

        return redirect()->route('tasker.profile.edit')->with('success', 'Profile updated successfully!');
    }

    // Portfolio management
    public function portfolioIndex()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isTasker()) {
            abort(403, 'Access denied. Only taskers can manage portfolio.');
        }

        $portfolioItems = $user->portfolioItems()->with('category')->paginate(12);

        return view('tasker.portfolio.index', compact('portfolioItems'));
    }

    public function portfolioCreate()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isTasker()) {
            abort(403, 'Access denied. Only taskers can create portfolio items.');
        }

        $categories = Category::active()->get();
        $userTasks = $user->tasks()->where('status', 'completed')->get();

        return view('tasker.portfolio.create', compact('categories', 'userTasks'));
    }

    public function portfolioStore(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isTasker()) {
            abort(403, 'Access denied. Only taskers can create portfolio items.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'image_alt' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'task_id' => 'nullable|exists:tasks,id',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('portfolio', 'public');

        // Process tags
        $tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

        $portfolioItem = PortfolioItem::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'description_translations' => [
                'fr' => $request->description,
                'ar' => $request->description_ar,
            ],
            'image_path' => $imagePath,
            'image_alt' => $request->image_alt ?: $request->title,
            'category_id' => $request->category_id,
            'task_id' => $request->task_id,
            'tags' => $tags,
            'is_featured' => $request->boolean('is_featured'),
            'status' => 'active',
            'display_order' => PortfolioItem::where('user_id', $user->id)->max('display_order') + 1,
        ]);

        return redirect()->route('tasker.portfolio.index')->with('success', 'Portfolio item created successfully!');
    }

    public function portfolioEdit($id)
    {
        /** @var User $user */
        $user = Auth::user();
        $portfolioItem = PortfolioItem::where('user_id', $user->id)->findOrFail($id);

        $categories = Category::active()->get();
        $userTasks = $user->tasks()->where('status', 'completed')->get();

        return view('tasker.portfolio.edit', compact('portfolioItem', 'categories', 'userTasks'));
    }

    public function portfolioUpdate(Request $request, $id)
    {
        /** @var User $user */
        $user = Auth::user();
        $portfolioItem = PortfolioItem::where('user_id', $user->id)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'image_alt' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'task_id' => 'nullable|exists:tasks,id',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolioItem->image_path) {
                Storage::delete($portfolioItem->image_path);
            }
            $imagePath = $request->file('image')->store('portfolio', 'public');
            $portfolioItem->image_path = $imagePath;
        }

        // Process tags
        $tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

        $portfolioItem->update([
            'title' => $request->title,
            'description' => $request->description,
            'description_translations' => [
                'fr' => $request->description,
                'ar' => $request->description_ar,
            ],
            'image_alt' => $request->image_alt ?: $request->title,
            'category_id' => $request->category_id,
            'task_id' => $request->task_id,
            'tags' => $tags,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('tasker.portfolio.index')->with('success', 'Portfolio item updated successfully!');
    }

    public function portfolioDestroy($id)
    {
        /** @var User $user */
        $user = Auth::user();
        $portfolioItem = PortfolioItem::where('user_id', $user->id)->findOrFail($id);

        // Delete image file
        if ($portfolioItem->image_path) {
            Storage::delete($portfolioItem->image_path);
        }

        $portfolioItem->delete();

        return redirect()->route('tasker.portfolio.index')->with('success', 'Portfolio item deleted successfully!');
    }
}
