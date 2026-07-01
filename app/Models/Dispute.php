<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dispute extends Model
{
    protected $fillable = [
        'task_id',
        'complainant_id',
        'respondent_id',
        'admin_id',
        'subject',
        'subject_translations',
        'description',
        'description_translations',
        'evidence',
        'status',
        'priority',
        'admin_notes',
        'resolution',
        'resolution_translations',
        'resolved_at',
    ];

    protected $casts = [
        'subject_translations' => 'array',
        'description_translations' => 'array',
        'resolution_translations' => 'array',
        'evidence' => 'array',
        'resolved_at' => 'datetime',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function complainant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'complainant_id');
    }

    public function respondent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'respondent_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'complainant_id');
    }

    public function tasker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'respondent_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Helper methods for multilingual fields
    public function getSubjectAttribute($value)
    {
        $locale = app()->getLocale();

        if ($this->subject_translations && isset($this->subject_translations[$locale])) {
            return $this->subject_translations[$locale];
        }

        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();

        if ($this->description_translations && isset($this->description_translations[$locale])) {
            return $this->description_translations[$locale];
        }

        return $value;
    }

    public function getResolutionAttribute($value)
    {
        $locale = app()->getLocale();

        if ($this->resolution_translations && isset($this->resolution_translations[$locale])) {
            return $this->resolution_translations[$locale];
        }

        return $value;
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
