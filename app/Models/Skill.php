<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'name_translations',
        'description',
        'description_translations',
        'category_id',
        'icon',
        'color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name_translations' => 'array',
        'description_translations' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_skills')
            ->withPivot(['experience_level', 'years_experience', 'description', 'is_verified', 'verified_at'])
            ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Helper methods
    public function getName($locale = 'fr')
    {
        if ($this->name_translations && isset($this->name_translations[$locale])) {
            return $this->name_translations[$locale];
        }

        return $this->name;
    }

    public function getDescription($locale = 'fr')
    {
        if ($this->description_translations && isset($this->description_translations[$locale])) {
            return $this->description_translations[$locale];
        }

        return $this->description;
    }
}
