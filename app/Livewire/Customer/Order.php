<?php

namespace App\Livewire\Customer;

use App\Models\Order as CustomerOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{

    use WithPagination;
    protected string $paginationTheme = 'bootstrap';




    public function render()
    {
        $orders = CustomerOrder::where(
            'user_id',
            auth()->id()
        )
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view(
            'livewire.customer.order',
            compact('orders')
        )->layout('layouts.frontend', ['title' => 'Customer Order']);
    }
}
