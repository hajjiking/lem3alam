<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageDelivery extends Model
{
    protected $fillable = ['message_id', 'transport', 'status', 'attempts', 'meta'];

    protected $casts = ['meta' => 'array'];
}
