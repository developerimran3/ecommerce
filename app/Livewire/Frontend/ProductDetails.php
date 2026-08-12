<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;

    public $qty = 1;

    public function mount($slug)
    {
        $this->product = Product::with([
            'category',
            'brand',
            'images',
        ])->where(
            'slug',
            $slug
        )->firstOrFail();
    }

    public function increaseQty()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }


    public function addToCart()
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);

        $item = CartItem::where(
            'cart_id',
            $cart->id
        )->where(
            'product_id',
            $this->product->id
        )->first();

        if ($item) {

            $item->increment(
                'qty',
                $this->qty
            );

            $item->update([
                'subtotal' => $item->qty * $item->price,
            ]);
        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'qty' => $this->qty,
                'price' => $this->product->final_price,
                'subtotal' => $this->product->final_price * $this->qty,
            ]);
        }

        $this->dispatch('cartUpdated');
        $this->dispatch(
            'success',
            message: 'Product added to cart.'
        );
    }
    public function orderNow()
    {
        $this->addToCart();
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view(
            'livewire.frontend.product-details'
        )->layout('layouts.frontend');
    }
}
