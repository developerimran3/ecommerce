<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public $search = '';
    public $status = '';

    public $selectedOrder = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }
    public function clearFilters()
    {
        $this->reset([
            'search',
            'status',
        ]);
        $this->resetPage();
    }


    public function showOrder($id)
    {
        $this->selectedOrder = Order::with([
            'items.product',
            'user',
        ])->findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $status,
        ]);
        $this->dispatch(
            'success',
            message: 'Order status updated.'
        );
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        if ($order->order_status === 'delivered') {
            $this->dispatch(
                'error',
                message: 'Delivered order cannot be deleted.'
            );
            return;
        }
        $order->items()->delete();
        $order->delete();
        $this->dispatch(
            'success',
            message: 'Order deleted successfully.'
        );
    }

    public function render()
    {
        $orders = Order::with([
            'user',
        ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where(
                        'invoice_no',
                        'like',
                        '%' . $this->search . '%'
                    )
                        ->orWhere(
                            'name',
                            'like',
                            '%' . $this->search . '%'
                        )

                        ->orWhere(
                            'phone',
                            'like',
                            '%' . $this->search . '%'
                        );
                });
            })

            ->when($this->status, function ($query) {
                $query->where(
                    'order_status',
                    $this->status
                );
            })
            ->latest()
            ->paginate(10);

        return view(
            'livewire.admin.order.index',
            compact('orders')
        )->layout('layouts.admin', ['title' => 'Orders']);
    }
}
