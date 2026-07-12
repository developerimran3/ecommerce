<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;

class CartCount extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function render()
    {
        $count = Cart::where('session_id', session()->getId())
            ->withCount('items')
            ->first()?->items_count ?? 0;

        return view(
            'livewire.frontend.cart-count',
            compact('count')
        );
    }
}
