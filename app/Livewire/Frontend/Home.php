<?php

namespace App\Livewire\Frontend;


use App\Models\Banner;
use App\Models\BannerCategory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function addToCart($productId)
    {
        $product = Product::select('id', 'price', 'discount_price')
            ->findOrFail($productId);
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->qty++;
            $item->subtotal = $item->qty * $item->price;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => 1,
                'price' => $product->final_price,
                'subtotal' => $product->final_price,
            ]);
        }
        $this->dispatch('cartUpdated');
        $this->dispatch(
            'success',
            message: 'Product added to cart.'
        );
    }


    public function render()
    {
        /*
        |--------------------------------------------------------------------------
        | ALL ACTIVE CATEGORIES
        |--------------------------------------------------------------------------
        | Category Menu + Category Slider
        */

        $categories = Category::where('status', true)
            ->orderBy('id', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | HOME PRODUCT CATEGORIES
        |--------------------------------------------------------------------------
        | Only fontview = 1
        */

        $frontCategory = Category::where('status', true)
            ->where('front_view', true)
            ->get();



        /*
        |--------------------------------------------------------------------------
        | HOT DEAL PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = Product::where('status', true)
            ->where('hot_deals', true)
            ->latest()
            ->take(10)
            ->get();

        // MAIN SLIDER
        $sliderCategory = BannerCategory::where('placement', 'main_slider')
            ->where('status', true)
            ->first();

        $homeSlider = $sliderCategory
            ? $sliderCategory->banners()
            ->where('status', true)
            ->latest()
            ->get()
            : collect();


        // PROMO BANNER
        $promoCategory = BannerCategory::where('placement', 'promo_banner')
            ->where('status', true)
            ->first();

        $promoBanner = $promoCategory
            ? $promoCategory->banners()
            ->where('status', true)
            ->latest()
            ->get()
            : collect();


        // FOOTER BANNER
        $footerCategory = BannerCategory::where('placement', 'footer_banner')
            ->where('status', true)
            ->first();

        $footerBanner = $footerCategory
            ? $footerCategory->banners()
            ->where('status', true)
            ->latest()
            ->get()
            : collect();



        return view('livewire.frontend.home', [
            // All category
            'categories' => $categories,
            // Only front_view category
            'frontCategory' => $frontCategory,
            // Hot deals
            'products' => $products,

            // Hero banner
            'homeSlider' => $homeSlider,
            'promoBanner' => $promoBanner,
            'footerBanner' => $footerBanner,


        ])->layout('layouts.frontend', [
            'title' => 'Home',
        ]);
    }
}
