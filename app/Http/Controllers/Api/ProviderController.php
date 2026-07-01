<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function nearby(Request $request)
    {
        $data = $request->validate([
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'radius' => ['nullable', 'numeric', 'min:0.1', 'max:200'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $radius = (float) ($data['radius'] ?? 25);
        $limit = (int) ($data['limit'] ?? 50);

        $centerLat = $data['latitude'] ?? $request->user()->latitude;
        $centerLng = $data['longitude'] ?? $request->user()->longitude;

        if ($centerLat === null || $centerLng === null) {
            return response()->json([
                'success' => false,
                'message' => 'Location is required',
                'errors' => [
                    'latitude' => ['Latitude is required'],
                    'longitude' => ['Longitude is required'],
                ],
            ], 422);
        }

        $centerLat = (float) $centerLat;
        $centerLng = (float) $centerLng;

        $distanceSql = '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))';

        $providers = User::query()
            ->select(['id', 'name', 'latitude', 'longitude'])
            ->selectRaw("$distanceSql as distance", [$centerLat, $centerLng, $centerLat])
            ->where('role', 'tasker')
            ->where('status', 'active')
            ->where('available', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->limit($limit)
            ->get()
            ->map(function (User $u) {
                return [
                    'id' => $u->id,
                    'name' => $u->name,
                    'latitude' => (float) $u->latitude,
                    'longitude' => (float) $u->longitude,
                    'distance' => round((float) $u->distance, 3),
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'data' => $providers,
        ]);
    }
}

