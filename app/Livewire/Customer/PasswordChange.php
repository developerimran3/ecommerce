<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordChange extends Component
{


    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {

            $this->addError(
                'current_password',
                'Current password is incorrect.'
            );

            return;
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        $this->dispatch(
            'success',
            message: 'Password updated successfully.'
        );
    }


    public function render()
    {

        return view('livewire.customer.password-change')
            ->layout('layouts.frontend', ['title' => 'Change Password']);
    }
}
