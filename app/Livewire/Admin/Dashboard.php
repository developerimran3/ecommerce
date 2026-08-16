<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalSales = Order::where(
            'order_status',
            'delivered'
        )->sum('grand_total');

        $totalOrders = Order::count();

        $totalCustomers = User::count();

        $totalProducts = Product::count();

        $pendingOrders = Order::where(
            'order_status',
            'pending'
        )->count();

        $processingOrders = Order::where(
            'order_status',
            'processing'
        )->count();

        $deliveredOrders = Order::where(
            'order_status',
            'delivered'
        )->count();

        return view('livewire.admin.dashboard', [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'pendingOrders' => $pendingOrders,
            'processingOrders' => $processingOrders,
            'deliveredOrders' => $deliveredOrders,
        ])->layout('layouts.admin', ['title' => 'The Kindom Of Fashion',]);
    }
}
