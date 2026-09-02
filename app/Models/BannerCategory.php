<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BannerCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'placement',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function banners()
    {
        return $this->hasMany(
            Banner::class,
            'banner_category_id'
        );
    }

    protected static function booted()
    {
        static::creating(function ($category) {

            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {

            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
