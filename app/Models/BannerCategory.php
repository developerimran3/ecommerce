<?php

namespace App\Models;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;

class BannerCategory extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
