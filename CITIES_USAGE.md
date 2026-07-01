# Morocco Cities Data Implementation

This document explains how to use the Morocco cities data that has been integrated into the M3alam application.

## Overview

The cities data includes:
- **12 regions** of Morocco with their cities
- **20 major cities** for quick access
- **French and Arabic names** for all cities and regions
- **Helper functions** for easy data manipulation

## Files Created

1. **Config File**: `config/cities.php` - Contains all cities and regions data
2. **Helper Class**: `app/Helpers/CitiesHelper.php` - Provides utility functions
3. **Controller**: `app/Http/Controllers/CitiesController.php` - API endpoints
4. **Routes**: Added to `routes/api.php` - Public API endpoints

## API Endpoints

All endpoints are available under `/api/v1/cities/`:

### Get All Regions
```
GET /api/v1/cities/regions
```
Returns all 12 regions with their cities.

### Get Major Cities
```
GET /api/v1/cities/major
```
Returns the 20 major cities of Morocco.

### Get All Cities (Flat List)
```
GET /api/v1/cities/all?lang=fr
GET /api/v1/cities/all?lang=ar
```
Returns all cities as a flat list. Use `lang` parameter for Arabic names.

### Search Cities
```
GET /api/v1/cities/search?q=casa
```
Search cities by name (supports both French and Arabic).

### Get Cities by Region
```
GET /api/v1/cities/region/casablanca_settat
```
Returns all cities in a specific region.

### Get City Information
```
GET /api/v1/cities/casablanca
```
Returns detailed information about a specific city.

## Helper Functions

Use the `CitiesHelper` class in your code:

```php
use App\Helpers\CitiesHelper;

// Get all regions
$regions = CitiesHelper::getAllRegions();

// Get major cities
$majorCities = CitiesHelper::getMajorCities();

// Search cities
$results = CitiesHelper::searchCities('casa');

// Get cities by region
$cities = CitiesHelper::getCitiesByRegion('casablanca_settat');

// Get city info
$cityInfo = CitiesHelper::getCityInfo('casablanca');
```

## Usage in Views

You can use the helper in Blade templates:

```php
@php
use App\Helpers\CitiesHelper;
$majorCities = CitiesHelper::getMajorCities();
@endphp

<select name="city">
    @foreach($majorCities as $key => $city)
        <option value="{{ $key }}">{{ $city['name'] }}</option>
    @endforeach
</select>
```

## Data Structure

### Regions
Each region contains:
- `name`: French name
- `name_ar`: Arabic name  
- `cities`: Array of cities in the region

### Cities
Each city contains:
- `name`: French name
- `name_ar`: Arabic name
- `region`: Region key (for major cities)
- `is_major`: Boolean flag (for some cities)
- `is_capital`: Boolean flag (for Rabat)

## Examples

### Creating a City Dropdown
```php
$cities = CitiesHelper::getAllCities();
// Returns: ['casablanca' => 'Casablanca', 'rabat' => 'Rabat', ...]
```

### Getting Arabic City Names
```php
$cities = CitiesHelper::getAllCitiesArabic();
// Returns: ['casablanca' => 'الدار البيضاء', 'rabat' => 'الرباط', ...]
```

### Searching Cities
```php
$results = CitiesHelper::searchCities('الدار');
// Returns cities matching the Arabic search term
```

This implementation provides a comprehensive solution for handling Morocco's cities data in both French and Arabic languages.