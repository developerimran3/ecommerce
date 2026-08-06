<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;


class MyOrders extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public function render()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view(
            'livewire.frontend.my-orders',
            compact('orders')
        )->layout('layouts.frontend');
    }
}
