<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'task_id',
        'sender_id',
        'receiver_id',
        'content',
        'content_translations',
        'attachments',
        'type',
        'is_read',
        'read_at',
        'is_deleted_by_sender',
        'is_deleted_by_receiver',
    ];

    protected $casts = [
        'content_translations' => 'array',
        'attachments' => 'array',
        'is_read' => 'boolean',
        'is_deleted_by_sender' => 'boolean',
        'is_deleted_by_receiver' => 'boolean',
        'read_at' => 'datetime',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Helper methods
    public function getContentAttribute($value)
    {
        $locale = app()->getLocale();

        if ($this->content_translations && isset($this->content_translations[$locale])) {
            return $this->content_translations[$locale];
        }
        if ($value) {
            try {
                return decrypt($value);
            } catch (\Throwable $e) {
                return $value;
            }
        }

        return $value;
    }

    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeBetweenUsers($query, $user1Id, $user2Id)
    {
        return $query->where(function ($q) use ($user1Id, $user2Id) {
            $q->where('sender_id', $user1Id)->where('receiver_id', $user2Id);
        })->orWhere(function ($q) use ($user1Id, $user2Id) {
            $q->where('sender_id', $user2Id)->where('receiver_id', $user1Id);
        });
    }

    public function scopeForTask($query, $taskId)
    {
        return $query->where('task_id', $taskId);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)->orWhere('receiver_id', $userId);
        });
    }
}
