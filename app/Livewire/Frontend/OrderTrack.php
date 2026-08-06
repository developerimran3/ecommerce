<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;

class OrderTrack extends Component
{
    public $phone;
    public $invoice_no;
    public $orders;

    protected $rules = [
        'phone' => 'required|digits:11',
        'invoice_no' => 'nullable|string',
    ];

    public function trackOrder()
    {
        $this->validate();

        $query = Order::with('items.product')
            ->where('phone', $this->phone);

        if ($this->invoice_no) {
            $query->where('invoice_no', $this->invoice_no);
        }

        $this->orders = $query
            ->latest()
            ->take(3)
            ->get();

        if ($this->orders->isEmpty()) {
            $this->dispatch('error', message: 'No order found.');
            return;
        }

        $this->dispatch('success', message: 'Order found successfully.');
    }

    public function render()
    {
        return view('livewire.frontend.order-track')
            ->layout('layouts.frontend');
    }
}
