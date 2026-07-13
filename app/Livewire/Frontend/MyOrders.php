<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;


class MyOrders extends Component
{
    use WithPagination;

    public $selectedOrder = null;

    public function showOrder($id)
    {
        $this->selectedOrder = Order::with([
            'items.product',
        ])->findOrFail($id);
    }

    public function render()
    {
        $orders = Order::withCount('items')
            ->latest()
            ->paginate(10);

        return view(
            'livewire.frontend.my-orders',
            compact('orders')
        )->layout('layouts.frontend');
    }
}
