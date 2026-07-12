<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class CartPage extends Component
{
    public function increaseQty($id)
    {
        $item = CartItem::findOrFail($id);

        $item->increment('qty');

        $item->update([
            'subtotal' => $item->qty * $item->price
        ]);
    }

    public function decreaseQty($id)
    {
        $item = CartItem::findOrFail($id);

        if ($item->qty > 1) {

            $item->decrement('qty');

            $item->update([
                'subtotal' => $item->qty * $item->price
            ]);
        }
    }

    public function removeItem($id)
    {
        CartItem::findOrFail($id)->delete();

        $this->dispatch(
            'success',
            message: 'Item removed from cart.'
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

        return view(
            'livewire.frontend.cart-page',
            compact('cart', 'total')
        )->layout('layouts.frontend');
    }
}
