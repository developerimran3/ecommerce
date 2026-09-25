<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'title',
        'sub_title',
        'white_logo',
        'dark_logo',
        'favicon',
        'phone',
        'email',
        'address',

    ];
    protected $table = 'settings';
}
