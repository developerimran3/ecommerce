<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Account extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->take(5)
            ->get();

        $completedOrders = Order::where(
            'user_id',
            auth()->id()
        )
            ->where('order_status', 'delivered')
            ->count();


        $pendingOrders = Order::where(
            'user_id',
            auth()->id()
        )
            ->where('order_status', 'pending')
            ->count();

        return view(
            'livewire.customer.account',
            [
                'orders' => $orders,
                'completedOrders' => $completedOrders,
                'pendingOrders' => $pendingOrders

            ]
        )
            ->layout('layouts.frontend', ['title' => 'Customer Account']);
    }
}
