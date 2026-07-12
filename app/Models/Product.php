<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'thumbnail',
        'price',
        'discount_price',
        'stock',
        'short_description',
        'description',
        'featured',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }




    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?: $this->price;
    }
}
