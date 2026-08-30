<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourierSetting extends Model
{
    protected $fillable = [
        'name',
        'courier_name',
        'base_url',
        'api_url',
        'api_key',
        'secret_key',
        'username',
        'password',
        'account_id',
        'store_id',
        'sandbox',
        'status',
    ];

    protected $casts = [
        'sandbox' => 'boolean',
        'status' => 'boolean',
    ];
}
