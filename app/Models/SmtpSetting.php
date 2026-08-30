<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    protected $fillable = [
        'name',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_email',
        'from_name',
        'status',
    ];

    protected $casts = [
        'port'   => 'integer',
        'status' => 'boolean',
    ];
}
