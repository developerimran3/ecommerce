<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MyAccount extends Component
{

    public $user;


    public function mount()
    {
        $this->user = Auth::user();
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
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
            'livewire.frontend.my-account',
            [
                'orders' => $orders,
                'completedOrders' => $completedOrders,
                'pendingOrders' => $pendingOrders

            ]
        )
            ->layout('layouts.frontend');
    }
}
