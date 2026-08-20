<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingArea extends Model
{
    protected $fillable = [
        'name',
        'charge',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'charge' => 'decimal:2',
    ];
}
