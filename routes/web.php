<?php

use App\Livewire\Backend\Brand;
use App\Livewire\Backend\Category;
use App\Livewire\Backend\Product;
use App\Livewire\Backend\Tag;
use App\Livewire\Dashboard\Admin;

use App\Livewire\Frontend\Cart;
use App\Livewire\Frontend\Checkout;
use App\Livewire\Frontend\Order;
use App\Livewire\Frontend\Shop;
use App\Livewire\Frontend\SignalProduct;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', Admin::class);
Route::get('/dashboard/product', Product::class);
Route::get('/dashboard/category', Category::class);
Route::get('/dashboard/tag', Tag::class);
Route::get('/dashboard/brand', Brand::class);


Route::get('/shop', Shop::class);
Route::get('/order', Order::class);
Route::get('/cart', Cart::class);
Route::get('/checkout', Checkout::class);
Route::get('/signal-product', SignalProduct::class);
