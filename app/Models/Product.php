<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'tag_id',
        'name',
        'slug',
        'sku',
        'thumbnail',
        'price',
        'discount_price',
        'stock',
        'short_description',
        'description',
        'status',
        'hot_deals',
    ];

    protected $casts = [
        'status' => 'boolean',
        'hot_deals' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Product Images
    |--------------------------------------------------------------------------
    */

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Reviews
    |--------------------------------------------------------------------------
    */

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Colors
    |--------------------------------------------------------------------------
    */

    public function colors()
    {
        return $this->belongsToMany(
            Color::class,
            'color_product',
            'product_id',
            'color_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Sizes
    |--------------------------------------------------------------------------
    */

    public function sizes()
    {
        return $this->belongsToMany(
            Size::class,
            'product_size',
            'product_id',
            'size_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Final Price
    |--------------------------------------------------------------------------
    */

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?: $this->price;
    }
}
