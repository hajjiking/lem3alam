<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Get user profile
     */
    public function profile(Request $request)
    {
        $user = $request->user()->load(['tasks', 'reviews']);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Profile retrieved successfully',
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'sometimes|string|max:20',
            'bio_fr' => 'sometimes|string|max:1000',
            'bio_ar' => 'sometimes|string|max:1000',
            'location' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update other fields
        $user->fill($request->only([
            'name', 'email', 'phone', 'bio_fr', 'bio_ar',
            'location', 'latitude', 'longitude',
        ]));

        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Profile updated successfully',
        ]);
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully',
        ]);
    }

    /**
     * Upload Avatar
     *
     * Upload a new avatar for the user.
     *
     * @bodyParam avatar file required The image file for the avatar.
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar uploaded successfully',
            'data' => [
                'avatar_url' => Storage::url($avatarPath),
            ],
        ]);
    }

    /**
     * Delete Avatar
     *
     * Remove the user's current avatar.
     */
    public function deleteAvatar(Request $request)
    {
        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Avatar deleted successfully',
        ]);
    }

    /**
     * Get user statistics
     */
    public function stats(Request $request)
    {
        $user = $request->user();

        $stats = [
            'total_tasks_created' => $user->tasks()->count(),
            'completed_tasks' => $user->tasks()->where('status', 'completed')->count(),
            'total_applications' => $user->applications()->count(),
            'accepted_applications' => $user->applications()->where('status', 'accepted')->count(),
            'average_rating' => $user->reviews()->avg('rating') ?? 0,
            'total_reviews' => $user->reviews()->count(),
            'total_earnings' => \App\Models\Payment::where('payee_id', $user->id)->where('status', 'completed')->sum('amount'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'User statistics retrieved successfully',
        ]);
    }

    /**
     * Get public user profile
     */
    public function show($id)
    {
        $user = User::with(['reviews' => function ($query) {
            $query->latest()->take(5);
        }])->find($id);

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Only show public information
        $publicData = [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'bio_fr' => $user->bio_fr,
            'bio_ar' => $user->bio_ar,
            'location' => $user->location,
            'created_at' => $user->created_at,
            'average_rating' => $user->reviews()->avg('rating') ?? 0,
            'total_reviews' => $user->reviews()->count(),
            'recent_reviews' => $user->reviews,
        ];

        return response()->json([
            'success' => true,
            'data' => $publicData,
            'message' => 'User profile retrieved successfully',
        ]);
    }
}
