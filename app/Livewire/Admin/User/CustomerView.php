<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class CustomerView extends Component
{

    public $customer;
    public $orders;

    public function mount($id)
    {
        $this->customer = User::findOrFail($id);

        $this->orders = $this->customer->orders()
            ->withCount('items')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.user.customer-view')
            ->layout('layouts.admin', [
                'title' => 'Customer Profile'
            ]);
    }
}
