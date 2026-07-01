<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PortfolioItem extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'description_translations',
        'image_path',
        'image_alt',
        'category_id',
        'task_id',
        'tags',
        'is_featured',
        'display_order',
        'status',
    ];

    protected $casts = [
        'description_translations' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('created_at', 'desc');
    }

    // Helper methods
    public function getDescription($locale = 'fr')
    {
        if ($this->description_translations && isset($this->description_translations[$locale])) {
            return $this->description_translations[$locale];
        }

        return $this->description;
    }

    public function getImageUrl()
    {
        if ($this->image_path) {
            return Storage::url($this->image_path);
        }

        return null;
    }

    public function getFullImagePath()
    {
        if ($this->image_path) {
            return Storage::path($this->image_path);
        }

        return null;
    }
}
