<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'payment_id',
        'task_id',
        'task_amount',
        'commission_rate',
        'commission_amount',
        'type',
        'status',
        'description',
        'collected_at',
    ];

    protected $casts = [
        'task_amount' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'collected_at' => 'datetime',
    ];

    // Relationships
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // Helper methods
    public static function calculateCommission($amount, $rate = 10.00)
    {
        return ($amount * $rate) / 100;
    }

    public function collect()
    {
        $this->update([
            'status' => 'collected',
            'collected_at' => now(),
        ]);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCollected($query)
    {
        return $query->where('status', 'collected');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
