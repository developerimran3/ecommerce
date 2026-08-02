<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;


use App\Models\Cart;
use App\Models\CartItem;

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
        return view('livewire.frontend.home', [

            'products' => Product::where('status', true)
                ->latest()
                ->paginate(12),

        ])->layout('layouts.frontend');
    }
}
