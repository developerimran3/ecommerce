<?php

namespace App\Livewire\Auth\Admin;

use Livewire\Component;

class ForgotPassword extends Component
{
    public function render()
    {
        return view('livewire.auth.admin.forgot-password')
            ->layout('layouts.guest', ['title' => 'Admin Forgot Password']);
    }
}
