<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'tasker_id',
        'proposal',
        'proposed_budget',
        'estimated_duration', // Add this line
        'status',
    ];

    protected $casts = [
        'proposal_translations' => 'array',
        'portfolio_items' => 'array',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
        'proposed_budget' => 'decimal:2',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function tasker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tasker_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tasker_id');
    }
}
