<?php

namespace App\Helpers;

class CitiesHelper
{
    /**
     * Get all regions with their cities
     */
    public static function getAllRegions()
    {
        return config('cities.morocco.regions', []);
    }

    /**
     * Get all major cities
     */
    public static function getMajorCities()
    {
        return config('cities.morocco.major_cities', []);
    }

    /**
     * Get cities for a specific region
     */
    public static function getCitiesByRegion($regionKey)
    {
        $regions = self::getAllRegions();

        return $regions[$regionKey]['cities'] ?? [];
    }

    /**
     * Get all cities as a flat array (for dropdowns)
     */
    public static function getAllCitiesFlat()
    {
        $regions = self::getAllRegions();
        $cities = [];

        foreach ($regions as $regionKey => $region) {
            foreach ($region['cities'] as $cityKey => $city) {
                $cities[$cityKey] = $city['name'];
            }
        }

        return $cities;
    }

    /**
     * Get all cities with full details for dropdowns
     */
    public static function getAllCitiesWithDetails()
    {
        $regions = self::getAllRegions();
        $majorCities = self::getMajorCities();
        $cities = [];

        foreach ($regions as $regionKey => $region) {
            foreach ($region['cities'] as $cityKey => $city) {
                $cities[] = [
                    'key' => $cityKey,
                    'name' => $city['name'],
                    'name_ar' => $city['name_ar'],
                    'region' => $region['name'],
                    'region_ar' => $region['name_ar'],
                    'is_major' => isset($majorCities[$cityKey]),
                ];
            }
        }

        return $cities;
    }

    /**
     * Get all cities with Arabic names as a flat array
     */
    public static function getAllCitiesFlatArabic()
    {
        $regions = self::getAllRegions();
        $cities = [];

        foreach ($regions as $regionKey => $region) {
            foreach ($region['cities'] as $cityKey => $city) {
                $cities[$cityKey] = $city['name_ar'];
            }
        }

        return $cities;
    }

    /**
     * Get cities grouped by region (for organized dropdowns)
     */
    public static function getCitiesGroupedByRegion()
    {
        $regions = self::getAllRegions();
        $grouped = [];

        foreach ($regions as $regionKey => $region) {
            $grouped[$region['name']] = [];
            foreach ($region['cities'] as $cityKey => $city) {
                $grouped[$region['name']][$cityKey] = $city['name'];
            }
        }

        return $grouped;
    }

    /**
     * Get cities grouped by region with Arabic names
     */
    public static function getCitiesGroupedByRegionArabic()
    {
        $regions = self::getAllRegions();
        $grouped = [];

        foreach ($regions as $regionKey => $region) {
            $grouped[$region['name_ar']] = [];
            foreach ($region['cities'] as $cityKey => $city) {
                $grouped[$region['name_ar']][$cityKey] = $city['name_ar'];
            }
        }

        return $grouped;
    }

    /**
     * Search cities by name
     */
    public static function searchCities($query, $locale = 'en')
    {
        $regions = self::getAllRegions();
        $results = [];
        $query = strtolower($query);

        foreach ($regions as $regionKey => $region) {
            foreach ($region['cities'] as $cityKey => $city) {
                $cityName = $locale === 'ar' ? $city['name_ar'] : $city['name'];
                if (strpos(strtolower($cityName), $query) !== false) {
                    $results[$cityKey] = [
                        'name' => $city['name'],
                        'name_ar' => $city['name_ar'],
                        'region' => $region['name'],
                        'region_ar' => $region['name_ar'],
                        'region_key' => $regionKey,
                    ];
                }
            }
        }

        return $results;
    }

    /**
     * Get city information by key
     */
    public static function getCityInfo($cityKey)
    {
        $regions = self::getAllRegions();

        foreach ($regions as $regionKey => $region) {
            if (isset($region['cities'][$cityKey])) {
                return [
                    'name' => $region['cities'][$cityKey]['name'],
                    'name_ar' => $region['cities'][$cityKey]['name_ar'],
                    'region' => $region['name'],
                    'region_ar' => $region['name_ar'],
                    'region_key' => $regionKey,
                    'is_major' => isset($region['cities'][$cityKey]['is_major']),
                    'is_capital' => isset($region['cities'][$cityKey]['is_capital']),
                ];
            }
        }

        return null;
    }

    /**
     * Get region information by key
     */
    public static function getRegionInfo($regionKey)
    {
        $regions = self::getAllRegions();

        return $regions[$regionKey] ?? null;
    }

    /**
     * Get only major cities for quick access
     */
    public static function getMajorCitiesOnly()
    {
        return array_map(function ($city) {
            return $city['name'];
        }, self::getMajorCities());
    }

    /**
     * Get only major cities with Arabic names
     */
    public static function getMajorCitiesOnlyArabic()
    {
        return array_map(function ($city) {
            return $city['name_ar'];
        }, self::getMajorCities());
    }

    /**
     * Check if a city is a major city
     */
    public static function isMajorCity($cityKey)
    {
        $majorCities = self::getMajorCities();

        return isset($majorCities[$cityKey]);
    }

    /**
     * Get cities for autocomplete (returns name and key)
     */
    public static function getCitiesForAutocomplete($locale = 'en')
    {
        $regions = self::getAllRegions();
        $cities = [];

        foreach ($regions as $regionKey => $region) {
            foreach ($region['cities'] as $cityKey => $city) {
                $cities[] = [
                    'key' => $cityKey,
                    'name' => $locale === 'ar' ? $city['name_ar'] : $city['name'],
                    'region' => $locale === 'ar' ? $region['name_ar'] : $region['name'],
                ];
            }
        }

        return $cities;
    }
}
