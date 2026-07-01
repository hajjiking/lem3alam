<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'client_id',
        'tasker_id',
        'task_id',
        'rating',
        'comment',
        'comment_translations',
        'status',
        'approved_at',
        'approved_by',
        'is_featured',
        'metadata',
        'reviewer_id',
        'reviewee_id',
        'type',
    ];

    protected $casts = [
        'comment_translations' => 'array',
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'rating' => 'integer',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function tasker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tasker_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewee_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Helper methods for multilingual comment
    public function getComment()
    {
        $locale = app()->getLocale();

        if ($this->comment_translations && isset($this->comment_translations[$locale])) {
            return $this->comment_translations[$locale];
        }

        return $this->comment;
    }

    public function getCommentInLocale($locale)
    {
        if ($this->comment_translations && isset($this->comment_translations[$locale])) {
            return $this->comment_translations[$locale];
        }

        return $this->comment;
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeForTasker($query, $taskerId)
    {
        return $query->where('tasker_id', $taskerId);
    }

    public function scopeByClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Helper methods
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function approve($approvedBy = null)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $approvedBy,
        ]);
    }

    public function reject()
    {
        $this->update([
            'status' => 'rejected',
        ]);
    }

    public function getStarsArray()
    {
        return array_fill(0, $this->rating, true) + array_fill($this->rating, 5 - $this->rating, false);
    }
}
