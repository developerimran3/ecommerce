<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Invoice extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order->load([
            'items.product',
        ]);
    }
    public function render()
    {
        return view('livewire.admin.order.invoice')
            ->layout('layouts.admin');
    }
}
