<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;

class InvoicePage extends Component
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
        return view(
            'livewire.frontend.invoice-page'
        )->layout('layouts.frontend');
    }
}
