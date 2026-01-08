<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'status',
        'idempotency_key',
        'grow_amount_in_cents',
        'net_amount_in_cents',
        'provider_external_id',
        'provider',
    ];
}
