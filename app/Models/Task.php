<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $appends = ['city'];

    protected $fillable = [
        'title',
        'title_translations',
        'description',
        'description_translations',
        'client_id',
        'category_id',
        'assigned_tasker_id',
        'budget_min',
        'budget_max',
        'budget_type',
        'payment_method',
        'location',
        'latitude',
        'longitude',
        'status',
        'urgency',
        'deadline',
        'required_skills',
        'images',
        'is_remote',
        'applications_count',
        'assigned_at',
        'started_at',
        'completed_at',
        'completion_requested_at',
    ];

    protected function casts(): array
    {
        return [
            'title_translations' => 'array',
            'description_translations' => 'array',
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'deadline' => 'datetime',
            'required_skills' => 'array',
            'images' => 'array',
            'is_remote' => 'boolean',
            'assigned_at' => 'datetime',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'completion_requested_at' => 'datetime',
        ];
    }

    public function getCityAttribute()
    {
        return $this->location;
    }

    // Mutators
    protected function setBudgetMaxAttribute($value)
    {
        // If budget_max is not provided or is null, set it to budget_min
        if (is_null($value) && isset($this->attributes['budget_min'])) {
            $this->attributes['budget_max'] = $this->attributes['budget_min'];
        } else {
            $this->attributes['budget_max'] = $value;
        }
    }

    // Boot method to handle creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            // Ensure budget_max is set when creating a task
            if (is_null($task->budget_max) && ! is_null($task->budget_min)) {
                $task->budget_max = $task->budget_min;
            }
        });
    }

    // Relationships
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function assignedTasker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_tasker_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(TaskApplication::class);
    }

    public function taskApplications(): HasMany
    {
        return $this->hasMany(TaskApplication::class, 'task_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function getTitle($locale = 'fr')
    {
        if ($this->title_translations && isset($this->title_translations[$locale])) {
            return $this->title_translations[$locale];
        }

        return $this->title;
    }

    public function getDescription($locale = 'fr')
    {
        if ($this->description_translations && isset($this->description_translations[$locale])) {
            return $this->description_translations[$locale];
        }

        return $this->description;
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', '%'.$location.'%');
    }

    public function scopeByBudget($query, $min, $max)
    {
        return $query->whereBetween('budget_min', [$min, $max])
            ->orWhereBetween('budget_max', [$min, $max]);
    }
}
