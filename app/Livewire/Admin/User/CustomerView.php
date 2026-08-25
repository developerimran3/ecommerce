<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class CustomerView extends Component
{

    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }


    public function render()
    {
        return view('livewire.admin.user.customer-view')
            ->layout('layouts.admin', [
                'title' => 'Customer Details'
            ]);
    }
}
