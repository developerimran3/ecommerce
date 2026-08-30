<?php

namespace App\Livewire\Admin\PayGateway;

use Livewire\Component;

class PaymentGateway extends Component
{
    public function render()
    {
        return view('livewire.admin.pay-gateway.payment-gateway')
            ->layout('layouts.admin', ['title' => 'Payment Gateway']);
    }
}
