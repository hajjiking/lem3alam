<?php

namespace App\Http\Controllers;

use App\Helpers\CitiesHelper;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Get all regions with their cities
     */
    public function getRegions()
    {
        return response()->json([
            'success' => true,
            'data' => CitiesHelper::getAllRegions(),
        ]);
    }

    /**
     * Get major cities
     */
    public function getMajorCities()
    {
        return response()->json([
            'success' => true,
            'data' => CitiesHelper::getMajorCities(),
        ]);
    }

    /**
     * Get cities by region
     */
    public function getCitiesByRegion($region)
    {
        $cities = CitiesHelper::getCitiesByRegion($region);

        if (empty($cities)) {
            return response()->json([
                'success' => false,
                'message' => 'Region not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cities,
        ]);
    }

    /**
     * Search cities
     */
    public function searchCities(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Query must be at least 2 characters',
            ], 400);
        }

        $results = CitiesHelper::searchCities($query);

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }

    /**
     * Get all cities as a flat list (for dropdowns)
     */
    public function getAllCities(Request $request)
    {
        $cities = CitiesHelper::getAllCitiesWithDetails();

        return response()->json([
            'success' => true,
            'data' => $cities,
        ]);
    }

    /**
     * Get city information
     */
    public function getCityInfo($cityKey)
    {
        $cityInfo = CitiesHelper::getCityInfo($cityKey);

        if (! $cityInfo) {
            return response()->json([
                'success' => false,
                'message' => 'City not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cityInfo,
        ]);
    }
}
