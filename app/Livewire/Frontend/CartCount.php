<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\On;

#[On('cartUpdated')]
class CartCount extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function removeItem($id)
    {
        CartItem::find($id)?->delete();
        $this->dispatch('cartUpdated');

        $this->dispatch(
            'success',
            message: 'Product Delete to cart.'
        );
    }

    public function render()
    {
        $cart = Cart::with('items.product')
            ->where('session_id', session()->getId())
            ->first();

        $total = $cart
            ? $cart->items->sum('subtotal')
            : 0;

        $count = $cart
            ? CartItem::where('cart_id', $cart->id)->sum('qty')
            : 0;

        return view('livewire.frontend.cart-count', compact('count', 'cart', 'total'));
    }
}
