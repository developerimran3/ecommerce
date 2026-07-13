<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view(
            'livewire.frontend.order-success'
        )->layout('layouts.frontend');
    }
}
