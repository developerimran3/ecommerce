<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        // শুধু নিজের Order দেখতে পারবে
        abort_unless(
            auth()->check() && $order->user_id === auth()->id(),
            403
        );

        // Order-এর প্রয়োজনীয় relationship load
        $this->order = $order->load([
            'items.product',
            'items.size',
            'items.color',
        ]);
    }

    public function render()
    {
        return view(
            'livewire.frontend.order-success'
        )->layout('layouts.frontend');
    }
}
