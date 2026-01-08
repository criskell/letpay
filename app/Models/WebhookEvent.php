<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookEvent extends Model
{
    protected $fillable = [
        'operation',
        'idempotency_key',
        'provider',
        'payload',
    ];
}
