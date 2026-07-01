<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserReport extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_user_id',
        'task_id',
        'message_id',
        'reason',
        'details',
        'status',
        'handled_by',
        'resolution_notes',
        'handled_at',
    ];

    protected $casts = [
        'handled_at' => 'datetime',
    ];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reportedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }
}
