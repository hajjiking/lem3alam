<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $user = $request->user();
        $user->forceFill([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ])->save();

        return response()->json([
            'success' => true,
            'message' => 'Location updated successfully',
            'data' => [
                'latitude' => (float) $user->latitude,
                'longitude' => (float) $user->longitude,
            ],
        ]);
    }
}

