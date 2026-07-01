<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        $name = (string) ($this->name ?? '');

        $bases = [];

        if ($name === 'Mounting (TVs, shelves, art, curtains, etc.)') {
            $bases[] = 'mounting';
        }

        if ($this->id) {
            $bases[] = (string) $this->id;
        }

        $slug = Str::slug($name);
        if ($slug !== '') {
            $bases[] = $slug;
        }

        $exts = ['jpg', 'jpeg', 'png', 'webp'];
        foreach ($bases as $base) {
            foreach ($exts as $ext) {
                $relative = "images/categories/{$base}.{$ext}";
                if (is_file(public_path($relative))) {
                    return asset($relative);
                }
            }
        }

        return null;
    }

    protected $fillable = [
        'name',
        'name_translations',
        'description',
        'description_translations',
        'icon',
        'color',
        'is_active',
        'sort_order',
        'parent_id',
    ];

    protected function casts(): array
    {
        return [
            'name_translations' => 'array',
            'description_translations' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeParents(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
