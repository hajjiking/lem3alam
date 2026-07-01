<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $fillable = [
        'task_id',
        'payer_id',
        'payee_id',
        'amount',
        'platform_fee',
        'net_amount',
        'currency',
        'method',
        'status',
        'transaction_id',
        'payment_details',
        'notes',
        'paid_at',
        'released_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'payment_details' => 'array',
        'paid_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payee_id');
    }

    public function payee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payee_id');
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    public function commission(): HasOne
    {
        return $this->hasOne(Commission::class);
    }

    // Helper methods
    public function calculatePlatformFee($rate = 0.10) // 10% default
    {
        $this->platform_fee = $this->amount * $rate;
        $this->net_amount = $this->amount - $this->platform_fee;

        return $this;
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    public function releasePayment()
    {
        $this->update([
            'released_at' => now(),
        ]);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCashPayments($query)
    {
        return $query->where('method', 'cash');
    }
}
